
<?php


/**
 * A report to display the outcome of scheduled backups
 *
 * @package    report
 * @subpackage template
 * @copyright  2023 paruls <>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');



admin_externalpage_setup('report_template', '', null, '', array('pagelayout'=>'report'));





echo $OUTPUT->header();




echo $OUTPUT->heading("Active logins", 4);

echo $OUTPUT->box_start();
echo" count of users (including teachers, and students) active in the LMS for the last 120 days 
;";
echo '<br/>';
$enrolled = $DB->get_records_sql("

SELECT id FROM  {user}   
WHERE DATEDIFF( NOW(),FROM_UNIXTIME(   lastlogin   ) ) < 120");



$count = count($enrolled);

echo "$count";

echo $OUTPUT->box_end();


echo '<br/>';

echo $OUTPUT->heading("Course Completions", 4);

echo $OUTPUT->box_start();
echo" Counts the number of learner completions from all the available courses in the system.";
echo '<br/>';
$timecompleted = $DB->get_records_sql("

SELECT p.timecompleted 

FROM {course_completions} p
");

$content = count($timecompleted);
echo "$content";

echo $OUTPUT->box_end();





    echo '<br/>';
echo $OUTPUT->heading("Enrolled users", 4);
echo $OUTPUT->box_start();
echo '<br/>';

echo"This report counts the enrolled users in course 3;";

  $enrolled = $DB->get_records_sql("

SELECT c.id, u.id

FROM {course} c
JOIN {context} ct ON c.id = ct.instanceid
JOIN {role_assignments} ra ON ra.contextid = ct.id
JOIN {user} u ON u.id = ra.userid
JOIN {role} r ON r.id = ra.roleid

where c.id = 3");

$countenrolls = count($enrolled);

echo "There are $countenrolls users in course 3";

echo $OUTPUT->box_end();

   
      


echo '<br/>';
echo $OUTPUT->heading("Categories Report", 4);
echo $OUTPUT->box_start();
echo '<br/>';

echo"This report lists the course categories and number of course count;";
echo '<br/>';

$courses = $DB-> get_records('course_categories');
       $table=new html_table();
       $table->head=array('Categories', 'Number of course count', );
    foreach ($courses as $course) {
      
       $name=$course->name;
       
         $coursecount=$course->coursecount;
         $table->data[]=array($name, $coursecount);
    }
    $contents .=html_writer::table($table); 
    echo $contents;
    echo $OUTPUT->box_end();
    ?>


<html>
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link rel="stylesheet" type="text/css" href="main.css">
   </head>
<body>
<div class="container">
<div class ="row">
  
<div class = "col-lg-4 col-md-3" >
   <div class="card_activeusers" style="width: 16rem; height:25vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Active users</p>
          <p><?php echo $count ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
      
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">

      </div>
  </div>
   </div>
</div>
</div>

<div class = "col-lg-4 col-md-3" >
   <div class="card_activelearners" style="width: 16rem; height:25vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Active learners</p>
          <p>[php code to place]</p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">

      </div>
  </div>
   </div>
</div>
</div>

</div>
   </div> 
   <p></p>
   <div class="container">
      <div class ="row">
        
      <div class = "col-lg-6 col-md-3" >
         <div class="card_nologincourses" style="width: 24rem; height:35vh;">
         <div class="row m-0">
         <div class="col-lg-8 col-md-4 p-0">
            <div class="content">
               
                <p>No login courses</p>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Total courses</th>
                      <th scope="col">No login courses</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">[php code to place]</th>
                      <td>[php code to place]</td>
                     
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 col-md-8 p-0">
            <div class="image_script">
               <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">
      
            </div>
        </div>
         </div>
      </div>
      </div>
      
      <div class = "col-lg-6 col-md-3" >
         <div class="card_courseparticipation" style="width: 24rem; height:35vh;">
         <div class="row m-0">
         <div class="col-lg-8 col-md-4 p-0">
            <div class="content">
               
                <p>Course participation</p>

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Enrollments</th>
                      <th scope="col">Completions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">[php code to place]</th>
                      <td>[php code to place]</td>
                     
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 col-md-8 p-0">
            <div class="image_script">
               <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">
      
            </div>
        </div>
         </div>
      </div>
      </div>
      
      </div>
         </div> 

         <p></p>

         <div class="container">
            <div class ="row">
            <div class = "col-lg-4 col-md-4" >
            
               <div class="card" style="width: 20rem;">
                  <p>Course Participation</p>
               </div>
            </div>
            <div class ="col-lg-4 col-md-4">
               <div class="card" style="width: 20rem;">
               <p>Users</p>
            
            </div>
            
            </div>
            <div class ="col-lg-4 col-md-4">
               <div class="card" style="width: 20rem;">
                  <p>Logins</p>
               
               </div>
               
               </div>
            </div>
               </div> 
               <p></p>

      <div class="container">
                  <div class ="row">
                  <div class = "col-lg-8 col-md-8" >
                     <div class="card">
                        <p>Average time spent by learners and teachers</p>
                     </div>
                  </div>
                  
                  <div class="column">
                  <div class ="col-lg-4 col-md-4">
                     <div class="card" style="width: 20rem;">
                     <p>Activities</p>
                  
                  </div>
                  
                  </div>
                  <p></p>
                     <div class ="col-lg-4 col-md-4">
                        <div class="card" style="width: 20rem;">
                           <p>Trending courses</p>
                        
                        </div>
                        
                        </div>
                  </div>
                  
                  </div>
                     </div> 
<p></p>
                     <div class="container">
                        <div class ="row">
                        <div class = "col-lg-12 col-md-12" >
                        
                           <div class="card">
                              <p>Learners Summary</p>
                           </div>
                        </div>
                       
                        
                        </div>
                           </div> 
                           <p></p>

<div class="container">
<div class ="row">
  
<div class = "col-lg-4 col-md-3" >
   <div class="card_coursecompletions" style="width: 16rem; height:25vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Course Completions</p>
          <p><?php echo $content ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
      
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">

      </div>
  </div>
   </div>
</div>
</div>

<div class = "col-lg-4 col-md-3" >
   <div class="card_enrolledusers" style="width: 16rem; height:25vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Enrolled users</p>
          <p><?php echo $countenrolls ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">

      </div>
  </div>
   </div>
</div>
</div>
<div class = "col-lg-4 col-md-3" >
   <div class="card_categoriesreport" style="width: 24rem; height:35vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Categories Report</p>
          <p><?php echo $contents ?>

       
  </div>
</div>
   </div> 
   <p></p>
</body>
</html>
    