<?php


/**
 * Class FilteringCustomers
 * @package Wpae\Pro\Filtering
 */
class FilteringCustomers extends FilteringUsers
{
    /**
     * @return bool
     */
    public function parse(){

        if ( $this->isFilteringAllowed()){
            $this->checkNewStuff();

            // No Filtering Rules defined
            if ( empty($this->filterRules)) {

                if ($this->isExportOnlyCustomersWithPurchases()) {

                    $this->queryJoin[] = " INNER JOIN {$this->wpdb->postmeta} AS `order_meta` ON ( {$this->wpdb->users}.ID = `order_meta`.`meta_value` AND `meta_key` =  '_customer_user') ";
                    $this->queryWhere .= " AND `order_meta`.`meta_id` IS NOT NULL GROUP BY {$this->wpdb->users}.ID, order_meta.meta_value";
                } else {

                    $this->queryJoin[] = " LEFT JOIN {$this->wpdb->postmeta} AS `order_meta` ON ( {$this->wpdb->users}.ID = `order_meta`.`meta_value` AND `meta_key` =  '_customer_user' ) ";
                    $this->queryJoin[] = " INNER JOIN {$this->wpdb->usermeta} AS `customer_user_meta` ON ( {$this->wpdb->users}.ID = `customer_user_meta`.user_id ) ";
                    $this->queryWhere .= " AND 
                    ( (`customer_user_meta`.`meta_key` = '{$this->wpdb->prefix}capabilities' AND `customer_user_meta`.`meta_value` LIKE '%customer%') OR (`order_meta`.`meta_id` IS NOT NULL)) GROUP BY {$this->wpdb->users}.ID, order_meta.meta_value";

                }

                return false;
            }

            $this->queryWhere = $this->isExportNewStuff() ? $this->queryWhere . " AND (" : " AND (";

            // Apply Filtering Rules
            foreach ($this->filterRules as $rule) {
                if ( is_null($rule->parent_id) ) {
                    $this->parse_single_rule($rule);
                }
            }

            if ($this->isExportOnlyCustomersWithPurchases()) {

                $this->meta_query = true;
                $this->queryJoin[] = " INNER JOIN {$this->wpdb->postmeta} AS `order_meta` ON ( {$this->wpdb->users}.ID = `order_meta`.`meta_value` AND `meta_key` =  '_customer_user' ) ";
                $this->queryWhere .= " AND `order_meta`.`meta_id` IS NOT NULL GROUP BY {$this->wpdb->users}.ID, order_meta.meta_value";
                var_dump($this->queryWhere); die;


            } else {
                $this->meta_query = true;
                $this->queryJoin[] = " INNER JOIN {$this->wpdb->postmeta} AS `order_meta` ON ( {$this->wpdb->users}.ID = `order_meta`.`meta_value` AND `meta_key` =  '_customer_user' ) ";
                $this->queryJoin[] = " INNER JOIN {$this->wpdb->usermeta} AS `customer_user_meta` ON ( {$this->wpdb->users}.ID = `customer_user_meta`.user_id ) ";
                $this->queryWhere .= " (AND `customer_user_meta`.`meta_key` = '{$this->wpdb->prefix}capabilities' AND `customer_user_meta`.`meta_value` LIKE '%\"customer\"%') OR (`order_meta`.`meta_id` IS NOT NULL GROUP BY {$this->wpdb->users}.ID, order_meta.meta_value)";
            }



            $this->queryWhere .= ")";


            if ($this->meta_query || $this->tax_query) {
                $this->queryWhere .= " GROUP BY {$this->wpdb->users}.ID";
            }

        }
    }

    /**
     * @return bool
     */
    protected function isExportOnlyCustomersWithPurchases(){
        return ( ! empty(\XmlExportEngine::$exportOptions['export_only_customers_that_made_purchases']));
    }

}