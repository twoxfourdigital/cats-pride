<?php
?>
<link rel="stylesheet" type="text/css" href="<?php echo $plugin_url.'/assets/css/select2.min.css'; ?>" >
<style type="text/css">
	#search-description{
		display: none;
	}
	#tool-options{
		width: 590px;
		background: #fff;
		border-style: solid;
		border-width: 2px 2px 2px 0px;	
		position: fixed;
		top:30%;
		left:-590px;
		transition: all 0.8s ease-in-out;

	}
	#tool-options.active{
		left:0px;
	}
	#tool-wrap {
        font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
        position: relative;
        padding:20px;
        font-size:14px;
        text-align:left;
    }
    #tool-wrap table th {
        text-align:left;
    }
	#show_menu {
		text-decoration: none;
        padding: 10px;
        color: #000;
        position: absolute;
        right: -72px;
        top: 42%;
        background: #fff;
        transform: rotate(-90deg);
        border: 2px solid;
        font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
	}
</style>