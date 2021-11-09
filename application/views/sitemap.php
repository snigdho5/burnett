<?php
$xmlString = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
    <loc> '.base_url().'<br/>'.' </loc>
</url>';

foreach ($product_list as $products) {
    $xmlString .=   '<url>';
	$xmlString .=  '<loc> '.base_url('product-details/'.$products->unique_key).'<br/>'.' </loc>';
    $xmlString .=  '</url>';
}

$xmlString .= '</urlset>';

echo $xmlString;

$dom = new DOMDocument;
$dom->preserveWhiteSpace = FALSE;
$dom->loadXML($xmlString);
if($dom->save($_SERVER["DOCUMENT_ROOT"].'/sitemap.xml')){
    echo "<h3>Site Map Created SuccessFully</h3>";
}else{
    echo "<h3>Site Map Created Failed</h3>";
}
?>