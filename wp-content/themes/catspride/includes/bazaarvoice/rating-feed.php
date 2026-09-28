<?php 
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
	header('Content-Type: text/html; charset=utf-8');
	require_once("../../../../wp-load.php"); //Loads WP function
?>

<?php

	$xml = new DOMDocument("1.0",'utf-8');

	$root = $xml->createElement("Feed");
	$xml->appendChild($root);

	$root->setAttributeNS('http://www.w3.org/2000/xmlns/', 'xmlns', 'http://www.bazaarvoice.com/xs/PRR/ProductFeed/5.6');

	$version = $xml->createAttribute('name');
	$root->appendChild($version);

	$value = $xml->createTextNode('catspride');
	$version->appendChild($value);

	$inc = $xml->createAttribute('incremental');
	$root->appendChild($inc);

	$value = $xml->createTextNode('false');
	$inc->appendChild($value);	

	$date = $xml->createAttribute('extractDate');
	$root->appendChild($date);

	$value = $xml->createTextNode(date('c'));
	$date->appendChild($value);	

	/** BRANDS **/
	$brands = $xml->createElement("Brands");
	$root->appendChild($brands);
		
	//loop brands
		$brand = $xml->createElement("Brand");
		$brands->appendChild($brand);	
		
		$exid = $xml->createElement("ExternalId");
		$brand->appendChild($exid);	
			
		$exidText = $xml->createTextNode("1");
		$exid->appendChild($exidText);	
		
		$name = $xml->createElement("Name");
		$brand->appendChild($name);	
			
		$nameText = $xml->createTextNode("Cats Pride");
		$name->appendChild($nameText);	
	
	/** CATEGORIES **/
	$categories = $xml->createElement("Categories");
	$root->appendChild($categories);

	$url = get_bloginfo('url');

    $args = array(
	      'orderby' => 'id',
	      'hide_empty'=> 1,
	      'posts_per_page' => '-1',
	      'exclude' => '-1'
	  );

    //loop categories
	$cat_query = get_categories($args);
	foreach ($cat_query as $cat) {

		$Category = $xml->createElement("Category");
		$categories->appendChild($Category);	
		
		$exid = $xml->createElement("ExternalId");
		$Category->appendChild($exid);	

		$exidText = $xml->createTextNode($cat->term_id );
		$exid->appendChild($exidText);	
		
		$name = $xml->createElement("Name");
		$Category->appendChild($name);	

		$nameText = $xml->createTextNode($cat->name);
		$name->appendChild($nameText);	
		
		$catpageurl = $xml->createElement("CategoryPageUrl");
		$Category->appendChild($catpageurl);	
		$catpageurlText = $xml->createTextNode($url . '/our-products/');
		$catpageurl->appendChild($catpageurlText);	
	}

	$products_query = new WP_Query('post_type=products&posts_per_page=-1');
			
	/** PRODUCTS **/
	$products = $xml->createElement("Products");
	$root->appendChild($products);

	while ($products_query->have_posts()) : $products_query->the_post();
				
		$id = $xml->createElement("ExternalId");
		$idText = $xml->createTextNode(get_the_ID());
		$id->appendChild($idText);
		
		$name  = $xml->createElement("Name");
		$nameText = $xml->createTextNode(get_the_title());
		$name->appendChild($nameText);
		
		$desc = $xml->createElement("Description");
		$descText = $xml->createTextNode(get_the_excerpt());
		$desc->appendChild($descText);

		$product_url = $xml->createElement("ProductPageUrl");
		$product_url_text = $xml->createTextNode(get_the_permalink());
		$product_url->appendChild($product_url_text);

		//Get first category
		$category = get_the_category();
		$firstCategory = $category[0]->term_id;

		$category = $xml->createElement("CategoryExternalId");
		$category_text = $xml->createTextNode($firstCategory);
		$category->appendChild($category_text);

		$brandID = $xml->createElement("BrandExternalId");
		$brandID_text = $xml->createTextNode("1");
		$brandID->appendChild($brandID_text);
		
		$url = get_bloginfo('url'); 
		$image = get_field('product_image'); 
		$image = $image['url']; 
		
		if($image == '') {
			$image = $url .'/wp-content/themes/cats-pride/imgs/site/coming-soon.png';
		}else{
			$image = $url . $image;
		}
		
		$img = $xml->createElement("ImageUrl");
		$imgText = $xml->createTextNode($image);
		$img->appendChild($imgText);

		$product = $xml->createElement("Product");
			$product->appendChild($id);
			$product->appendChild($name);
			$product->appendChild($desc);
			$product->appendChild($product_url);
			$product->appendChild($img);
			$product->appendChild($brandID);
			$product->appendChild($category);
		$products->appendChild($product);
		
	endwhile; wp_reset_query();

	$xml->formatOutput = true;
echo "<xmp>". $xml->saveXML() ."</xmp>";

$xml->save("cats-pride-products.xml") or die("Cannot Save");

?>
