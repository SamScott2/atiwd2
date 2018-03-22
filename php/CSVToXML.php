<?php
/*
 * php provide by Prakash Chatterjee
 * modified by Samuel scott
 * 
 */
echo "working .. wait";
ob_flush();
flush();


if (($handle = fopen("air_quality.csv", "r")) !== FALSE) {
    # define the tags - last col value in csv file is derived so ignore
    $header = array('id', 'desc', 'date', 'time', 'nox', 'no', 'no2', 'lat', 'long');
    # throw away the first line - field names
    fgetcsv($handle, 200, ",");

    # count the number of items in the $header array so we can loop using it
    $cols = count($header);

    #set record count to 1
    $count = 1;

    # set row count to 2 - this is the row in the original csv file
    $row = 2;



    # start ##################################################
    $wells_rd_out = '<records>';
    $brislington_out = '<records>';
    $fishponds_out = '<records>';
    $parson_st_out = '<records>';
    $rupert_st_out = '<records>';
    $newfoundland_way_out = '<records>';



    while (($data = fgetcsv($handle, 200, ",")) !== FALSE) {
//
        if ($data[0] == 6) {
//
            $rec = '<row count="' . $count . '" id="' . $row . '">';
            for ($c = 0; $c < $cols; $c++) {
                $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) . '"/>'; //
                //echo trim($data[$c]);
            }
            $rec .= '</row>';
            $count++;
            $fishponds_out .= $rec;
        }
        if ($data[0] == 8) {
//
            $rec = '<row count="' . $count . '" id="' . $row . '">';
            for ($c = 0; $c < $cols; $c++) {
                $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) . '"/>'; //
                //echo trim($data[$c]);
            }
            $rec .= '</row>';
            $count++;
            $parson_st_out .= $rec; //
        }
        if ($data[0] == 9) {
//
            $rec = '<row count="' . $count . '" id="' . $row . '">';
            for ($c = 0; $c < $cols; $c++) {
                $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) . '"/>'; //
                //echo trim($data[$c]);
            }
            $rec .= '</row>';
            $count++;
            $rupert_st_out .= $rec; //
        }
        if ($data[0] == 10) {
//
            $rec = '<row count="' . $count . '" id="' . $row . '">';
            for ($c = 0; $c < $cols; $c++) {
                $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) . '"/>'; //
                //echo trim($data[$c]);
            }
            $rec .= '</row>';
            $count++;
            $wells_rd_out .= $rec;
        }
        if ($data[0] == 11) {
//
            $rec = '<row count="' . $count . '" id="' . $row . '">';
            for ($c = 0; $c < $cols; $c++) {
                $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) . '"/>'; //
                //echo trim($data[$c]);
            }
            $rec .= '</row>';
            $count++;
            //
            $newfoundland_way_out .= $rec;
        }
        if ($data[0] == 3) {
//
            $rec = '<row count="' . $count . '" id="' . $row . '">';
            for ($c = 0; $c < $cols; $c++) {
                $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) . '"/>'; //
                //echo trim($data[$c]);
            }
            $rec .= '</row>';
            $count++;
            $brislington_out .= $rec; //
        }
        $row++;
    }
    $wells_rd_out .= '</records>';
    $brislington_out .= '</records>';
    $fishponds_out .= '</records>';
    $parson_st_out .= '</records>';
    $rupert_st_out .= '</records>';
    $newfoundland_way_out .= '</records>';
    # finish ##################################################
    # write out file
    file_put_contents('xml/wells_rd.xml', $wells_rd_out);
    file_put_contents('xml/brislington.xml', $brislington_out);
    file_put_contents('xml/fishponds.xml', $fishponds_out);
    file_put_contents('xml/parson_st.xml', $parson_st_out);
    file_put_contents('xml/rupert_st.xml', $rupert_st_out);
    file_put_contents('xml/newfoundland_way.xml', $newfoundland_way_out);
    fclose($handle);
}
echo "....all done!";
?>
