#CakePHP RecordTrac Port

This is a port of [RecordTrac] (https://github.com/postcode/recordtrac) using [CakePHP](http://www.cakephp.org) (2.5.3) as the framework. 
Although this project is called a "port," it does not follow the same conventions for JSON files and DB as the original RecordTrac.


##Installation Instructions
1. You will need to have [CakePHP](http://www.cakephp.org) (2.5.3) installed, install it from the instructions on their site
2. `record-trac.sql` is included with this, it is the structure for the database, import it into the database that you configured in CakePHP.
3. If you would like some test data (recommended), also import `record-trac-content.sql`
4. Copy the files from this package into the corresponding CakePHP folders, the following files will need to be edited rather than overwritten if you are installing to a CakePHP installation that already has applications running: 
	* app/Controller/AppController.php
5. Edit /app/Config/recordtrac.php to match your agency's information
6. In your app/Config/routes.php add thes lines (replacing the default). *make sure this is before pages route*
	>Router::connect('/', array('controller' => 'recordtrac', 'action' => 'index')); //sets recordtrac as default index for whole CakePHP install

	>Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));  //just a prettier for /about

	>Router::connect('/track', array('controller' => 'requests', 'action' => 'track', 'track')); // track is really part of requests, not a seperate controller

	>Router::connect('/track/:id', array('controller' => 'requests', 'action' => 'view'),array('pass' => array('id'))); //This routes /track/REQUESTID
7. You should now be able to go to your root URL and see the RecordTrac landing page. 
8. To login as a staff member, the credentials are: admin@example.com/letmein 
    
    ***YOU MUST CHANGE THESE CREDENTIALS BEFORE GOING INTO PRODUCTION*** 
9.Enjoy!

###Technologies Used
http://www.ekoim.com/blog/bootstrap-cakephp-bootstrapcake/ - CakePHP Bootstrap Layout Addition

http://getbootstrap.com - Twitter Bootstrap (as included in the above Layout)

http://www.cakephp.org - CakePHP

https://github.com/destinydriven/cakephp-high-charts-plugin - Charts on landing page

https://github.com/josegonzalez/cakephp-upload - file uploads for records