#CakePHP RecordTrac Port

This is a port of [RecordTrac] (https://github.com/postcode/recordtrac) using [CakePHP](http://www.cakephp.org) (2.5.3) as the framework. 
Although this project is called a "port," it does not follow the same conventions for JSON files and DB as the original RecordTrac.


##Installation Instructions
1. You will need to have [CakePHP](http://www.cakephp.org) (2.5.4) installed, install it from the instructions on their site.
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
8. To login as a staff member, the credentials are: admin@example.com/letmein (master admin page can be found at /admin)
    
    ***YOU MUST CHANGE THESE CREDENTIALS BEFORE GOING INTO PRODUCTION*** 
    
9. Enjoy!

If you have any questions, please [create an issue](https://github.com/randybondsjr/recordtrac-cakephp/issues) in github.

###Technologies Used
http://www.ekoim.com/blog/bootstrap-cakephp-bootstrapcake/ - CakePHP Bootstrap Layout Addition

http://getbootstrap.com - Twitter Bootstrap (as included in the above Layout)

http://www.cakephp.org - CakePHP

https://github.com/destinydriven/cakephp-high-charts-plugin - Charts on landing page

https://github.com/josegonzalez/cakephp-upload - file uploads for records

###Why Make a CakePHP port?
When researching RecordTrac, the usefullness of the product became immediately apparent. The functionality of the application and ease of use for users really impressed. It is a great product!

After getting a demo installed, there were a few items that could use some re-arranging. One of the big things was the seperation of JSON and Model data. It seemed unneccesarily complex to have the data seperated. For example, the department.json does not relate to the doctypes.json and so forth. So, in an effort to curb some of the extra editing, in the CakePHP version, all of that information is held in models. This makes it easier for assigned "super admins" to edit departments, users, and doctypes very easily. I also added in the ability for "super admins" to edit the copy for closures and extensions of requests. 

Another factor in the port was familiarity of the core technologies. Working with a python/postgresql code base is something that was doable, but not something that I am completely comfortable with. Realizing the huge impact this application would have on our organization, being very familiar with the base technologies was a must. Choosing CakePHP/mySQL was a matter of technologies that I am very familiar with, and would be comfortable supporting. It also came to reason that others may be in the same situation, thus the reason for openly sharing the project. 