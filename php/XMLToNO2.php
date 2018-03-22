<?php

/*
 * FORMAT:
 * <?xml version="1.0" encoding="UTF-8"?>
 * <data type="nitrogen dioxide">
 *  <location id="wells road" lat="51.427" long="-2.568">
 *      <reading date="13/02/2016" time="03:15:00" val="11"/>
 *      <reading date="13/02/2016" time="03:30:00" val="11"/>
 *      <reading date="13/02/2016" time="03:45:00" val="11"/>

 *      <!-- thouands of other rows -->

 *      <reading date="13/02/2017" time="16:15:00" val="35"/>

 *   </location>
 * </data>
 */

//define input and output file names.
$input = array("xml/brislington.xml", "xml/fishponds.xml", "xml/parson_st.xml", "xml/rupert_st.xml", "xml/wells_rd.xml", "xml/newfoundland_way.xml");
$output = array("brislington_NO2.xml", "fishponds_NO2.xml", "parson_st_NO2.xml", "rupert_st_NO2.xml", "wells_rd_NO2.xml", "newfoundland_way_NO2.xml");

echo "working .. wait";

for ($i = 0; $i < 6; $i++) {
    $XMLRdr = new XMLReader();
    $XMLRdr->open($input[$i]);

    $XMLWtr = new XMLWriter();
    $XMLWtr->openMemory();

    $XMLWtr->startDocument("1.0");
    $XMLWtr->setIndent("2");
    $XMLWtr->startElement("data");
    $XMLWtr->writeAttribute("type", "nitrogen dioxide");

    while ($XMLRdr->read() && $XMLRdr->name !== "row");

    $location = true;
    $doc = new DOMDocument;

    while ($XMLRdr->name === "row") {
        $element = simplexml_import_dom($doc->importNode($XMLRdr->expand(), true));

        //<location long="--" lat="--" id="-----">
        if ($location) {
            $XMLWtr->startElement("location");
            $XMLWtr->writeAttribute("id", $element->desc->attributes()->val);
            $XMLWtr->writeAttribute("lat", $element->lat->attributes()->val);
            $XMLWtr->writeAttribute("long", $element->long->attributes()->val);
            $location = false;
        }
        //<reading val="--" time="--:--:--" date="--/--/----"/>
        $XMLWtr->startElement("reading");
        $XMLWtr->writeAttribute("date", $element->date->attributes()->val);
        $XMLWtr->writeAttribute("time", $element->time->attributes()->val);
        $XMLWtr->writeAttribute("val", $element->no2->attributes()->val);
        $XMLWtr->endElement();
        $XMLRdr->next("row");
    }
    $XMLWtr->endElement();
    $XMLWtr->endElement();
    $XMLWtr->endDocument();

    //create files
    $xml = $XMLWtr->flush(true);
    file_put_contents('xml/no2/' . $output[$i], $xml);

    //not necessary, but good practice.
    $XMLRdr->close();
    echo ' </br>done processing ' . $input[$i] . ' ...';
}
echo '</br>Complete!';
?>