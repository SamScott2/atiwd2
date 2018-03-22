Advanced Topics in Web Development 2
=======
## Samuel Scott 15014063

## Files
---
**php Files**

1. php Script for extracting CSV data to create XML files:
  * [CSVToXML.php](https://github.com/SamScott2/atiwd2/blob/master/php/CSVToXML.php)
2. php Script for normalising the XML files to create XML files of the NO2 levels:
  * [XMLToNO2.php](https://github.com/SamScott2/atiwd2/blob/master/php/XMLToNO2.php)
---
**XML Files generated from php**
1. XML files created from CSV:
  * [brislington.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/brislington.xml) 
  * [fishponds.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/fishponds.xml)	
  * [newfoundland_way.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/newfoundland_way.xml)
  * [parson_st.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/parson_st.xml)
  * [rupert_st.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/rupert_st.xml)
  * [wells_rd.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/wells_rd.xml)
2. XML files For NO2 levels:
  * [brislington_NO2.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/no2/brislington_NO2.xml) 
  * [fishponds_NO2.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/no2/fishponds_NO2.xml)	
  * [newfoundland_way_NO2.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/no2/newfoundland_way_NO2.xml)
  * [parson_st_NO2.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/no2/parson_st_NO2.xml)
  * [rupert_st_NO2.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/no2/rupert_st_NO2.xml)
  * [wells_rd_NO2.xml](https://github.com/SamScott2/atiwd2/blob/master/php/xml/no2/wells_rd_NO2.xml)
---
**JavaScript file**
  * [loadXMLForCharts.js](https://github.com/SamScott2/atiwd2/blob/master/public_html/js/loadXMLForCharts.js)
---
**HTML file:**
  * [index.html](https://github.com/SamScott2/atiwd2/blob/master/public_html/index.html)
  * (CEMS)[index.html](http://www.cems.uwe.ac.uk/~s34-scott/index.html)
---
## XML parsers: DOM vs Stream
The Document Object Model or DOM is works by creating a DOM tree from a XML file in its entirety, that is to say the whole XML file is loaded as a tree structure into the progect this makes reading and writing data very quick. DOMs are Read/Write so the user is able to edit, insert, or delete nodes. the main draw back to DOMs are they eat up lots of memeory for large files.

Stream Parsers are event driven parsers. They don't store the XML file as it reads it instead will trigger events when it reaches a tag or end of a tag. Streaming parsers are not Read/Write like DOMs so cant be used to edit existing data. Other limitations of Stream parsers is that they are linear unlike DOMs which allow for backwards traversal of nodes, stream parsers dont have this feature.

DOM parsers offer more functionality and usability the stream parsers. This might lead one to think that DOMs are just better then Stream persers however there are drawbacks to DOMs as large file will use up lots of memory and can be intensive on the system. there are also plenty of times when you will not need the full functionality of the DOM and stream persers will be enough will also free up the system resources.

In conclusion, the context of the implementation will be the primary deciding factor in which parser would be best suited for the poject if the project only needs to read a file then use a stream parser. If you need the functionality of a DOM then use a DOM parser. 


## Charts and Refactoring

for both the scatterchart and linechart I used a textfield for the date and time inputs, I did this as it allow me to test a wide range of inputs and it gave me flexability and control. a weakness of this method would be that its not very pleasent to enter values in such a manner aswell as makes it more confusing as well as increases the chance of make errors when providing parameters. I also used a drop down menu for selecting stations which I think works well and save time have all the station easily accessable. If I were to do this again I might use HTML5 date and time selecters to immprove easability and try to filter out inputs that don't correspond to meaningful data.

on the topic of the charts an Improvement on visability might be to add extra data like a trend line to show the overall direction that the data is taking so user can see at a glance. 


