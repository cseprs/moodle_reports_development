
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




//echo $OUTPUT->heading("ED Reporting Dashboard", 4);

/*echo $OUTPUT->box_start();
echo" count of users (including teachers, and students) active in the LMS for the last 120 days 
;";
echo '<br/>'; */
$enrolled = $DB->get_records_sql("

SELECT id FROM  {user}   
WHERE DATEDIFF( NOW(),FROM_UNIXTIME(   lastlogin   ) ) < 120");



$count = count($enrolled);

/*echo "$count";

echo $OUTPUT->box_end();


echo '<br/>'; */

/*echo $OUTPUT->heading("Course Completions", 4);

echo $OUTPUT->box_start();
echo" Counts the number of learner completions from all the available courses in the system.";
echo '<br/>'; */
$timecompleted = $DB->get_records_sql("

SELECT p.timecompleted 

FROM {course_completions} p
");

$content = count($timecompleted);


$visitsssql = "SELECT DISTINCT userid
FROM {logstore_standard_log}
WHERE timecreated >= :starttime
AND timecreated < :endtime
AND userid < 1";
$params = array(
'starttime' => $starttime,
'endtime' => $endtime
);
$visits = $DB->get_records_sql($visitsssql, $params);

$sitevisits= count($visits);
/*echo "$content";

echo $OUTPUT->box_end();*/



/*$users = $DB->get_records('user');
foreach ($users as $user) {
 //$content = $user->firstname. '   ' . userdate($user->timecreated, get_string('strftimerecentfull'))."<br>";
 echo '<b>' . $user->firstname . '   ' . userdate($user->timecreated, get_string('strftimerecentfull')).'</b><br />'; 
}
$displaytable=new html_table();
$displaytable->head= array('firstname','Time created');
$displaytable->width='100%';
$col1='';
$col2='';
$col1width='40%';
$col2width='60%';
$allcolattributes= array();
$rowvalue=array();
$allrows=array();
//$users = $DB->get_records('user', ['id' => '4']);
$users = $DB->get_records('user');
foreach ($users as $user) {
 //$content = $user->firstname. '   ' . userdate($user->timecreated, get_string('strftimerecentfull'))."<br>";
 //echo $content;
   $col1.=firstname;
$col2.= userdate($user->timecreated, get_string('strftimerecentfull'));
array_push($allcolattributes, $col1width, $col2width);
array_push($rowvalue, $col1);
array_push($rowvalue, $col2);
array_push($allrows, $rowsvalue);
$col1='';
$col2='';
$rowvalue=array();



      $displaytable->data = $allrows; 
      $displaytable->size = $allcolattributes; 
      echo html_writer::table($displaytable); 
    
}
      
     // echo $content;
      echo $OUTPUT->box_end();

/*$courses = $DB-> get_records('course_categories');
       $table=new html_table();
       $table->head=array('Categories', 'Number of course count', );
    foreach ($courses as $course) {
       //$content = $course->fullname.'  ' .userdate($course->timecreated, get_string('strftimerecentfull')). '<br>';
       $name=$course->name;
         //$startdate=userdate($course->startdate, get_string('strftimerecentfull'));
         $coursecount=$course->coursecount;
         $table->data[]=array($name, $coursecount);
    }
    $content .=html_writer::table($table); */

   /* echo '<br/>';
echo $OUTPUT->heading("Enrolled users", 4);
echo $OUTPUT->box_start();
echo '<br/>';

echo"This report counts the enrolled users in course 3;";*/

  $enrolled = $DB->get_records_sql("

SELECT c.id, u.id

FROM {course} c
JOIN {context} ct ON c.id = ct.instanceid
JOIN {role_assignments} ra ON ra.contextid = ct.id
JOIN {user} u ON u.id = ra.userid
JOIN {role} r ON r.id = ra.roleid

where c.id = 3");

$countenrolls = count($enrolled);

/*echo "There are $countenrolls users in course 3";

echo $OUTPUT->box_end();

   
      


echo '<br/>';*/


/*echo $OUTPUT->heading("Total instructors", 4);
echo $OUTPUT->box_start();
echo '<br/>'; 

echo"This report counts total teachers;";*/

  $enrollteachers = $DB->get_records_sql("

SELECT ra.userid

FROM {role_assignments} ra
JOIN {context} ctx ON ra.contextid = ctx.id


where ra.roleid = 3");

$countteachers = count($enrollteachers);

/*echo "$countteachers ";

echo $OUTPUT->box_end();

   
      


echo '<br/>';*/




/*echo $OUTPUT->heading("Total instructors", 4);
echo $OUTPUT->box_start();
echo '<br/>';

echo"This report counts total teachers;";*/

  $enrollusers = $DB->get_records_sql("

SELECT ra.userid

FROM {role_assignments} ra
JOIN {context} ctx ON ra.contextid = ctx.id


where ra.roleid = 5");

$countusers = count($enrollusers);

/*echo "$countusers ";

echo $OUTPUT->box_end();

   
      


echo '<br/>';*/


/*echo $OUTPUT->heading("Categories Report", 4);
echo $OUTPUT->box_start();
echo '<br/>';

echo"This report lists the course categories and number of course count;";
echo '<br/>';*/

$courses = $DB-> get_records('course_categories');
       $table=new html_table();
       $table->head=array('Categories', 'Number of course count', );
    foreach ($courses as $course) {
      
       $name=$course->name;
       
         $coursecount=$course->coursecount;
         $table->data[]=array($name, $coursecount);
    }
    $contents .=html_writer::table($table); 
    /*echo $contents;
    echo $OUTPUT->box_end();*/
    ?>


<html>
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
    <link rel="stylesheet" type="text/css" href="main.css">
   </head>
<body>
<div class="report-header row m-0">
    <div class="page-title col-9 pl-0 text-center">
        <h2 class="theme-1-color">Reporting Dashboard</h2>
    </div>
    <div class="back-url col-3 pr-0 text-right">
        <a href="#" class="btn bg-primary text-white">Link to website</a>
    </div>
</div>
<div class="container">
<div class ="row">
  
<div class = "col-lg-4 col-md-3" >
   <div class="card_activeusers" style="width: 20rem; height:14vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Active users</p>
          <p><?php echo $count ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
      
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="50px">

      </div>
  </div>
   </div>
</div>
</div>
<div class = "col-lg-4 col-md-3" >
   <div class="card_activeusers" style="width: 20rem; height:14vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Learners</p>
          <p><?php echo $countusers ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
      
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="50px">

      </div>
  </div>
   </div>
</div>
</div>

<div class = "col-lg-4 col-md-3" >
   <div class="card_activelearners" style="width: 20rem; height:14vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Instructors</p>
          <p><?php echo $countteachers ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="50px">

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
  
<div class = "col-lg-4 col-md-3" >
   <div class="card_activeusers" style="width: 20rem; height:14vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Course Completions</p>
          <p><?php echo $content ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
      
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="50px">

      </div>
  </div>
   </div>
</div>
</div>
<div class = "col-lg-4 col-md-3" >
   <div class="card_activeusers" style="width: 20rem; height:14vh;">
   <div class="row m-0">
   <div class="col-lg-8 col-md-4 p-0">
      <div class="content">
         
          <p>Enrollments</p>
          <p><?php echo $countenrolls ?></p>
      </div>
  </div>
  <div class="col-lg-4 col-md-8 p-0">
      <div class="image_script">
      
         <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="50px">

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
         <div class="card_nologincourses" style="width: 35rem; height:18vh;">
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
        <div class="col-lg-4 col-md-8 p-0 text-right">
            <div class="image_script">
               <img src="learnscript/activelearners.jpg" alt="image" width="80px" height="80px">
      
            </div>
        </div>
         </div>
      </div>
      </div>
      
      <div class = "col-lg-6 col-md-3" >
         <div class="card_courseparticipation" style="width: 35rem; height:18vh;">
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
                      <th scope="row"><?php echo $countenrolls ?></th>
                      <td><?php echo $content ?></td>
                     
                    </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-4 col-md-8 p-0 text-right" >
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

         <div class="card text-white bg-primary">
    <div class="card-block">
        <div class="row mx-0">
            <div class="col-5">
                <div class="bold mb-1">
                    Todays Logins
                </div>
                <div class="mx-0 text-center text-green">
                    <div class="d-flex w-100 todays-block theme-2-bg">
                        <div class="m-auto">
                            <div id="todays-onlinelearners" class=" font-size-30 font-weight-600 w-full">
                                <div class="data">[php code to place]</div>
                            </div>
                            <label class="font-weight-400 font-3">
                                Todays Online Learners
                            </label>
                        </div>
                    </div>
                    <div class="d-flex w-100 todays-block theme-2-bg">
                        <div class="m-auto">
                            <div id="todays-onlineteachers" class=" font-size-30 font-weight-600 w-full">
                                <div class="data">[php code to place]</div>
                            </div>
                            <label class="font-weight-400 font-3">
                                Todays Online Teachers
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <table class="summary ml-auto">
                    <thead class="border-bottom">
                        <tr>
                            <th class="text-left">
                                Events
                            </th>
                            <th class="text-center">
                                Summary
                            </th>
                            <th class="text-right ">
                                Count
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">
                                Active users
                            </td>
                            <td class="text-center">
                                Active in the LMS for last 120 days
                            </td>
                            <td class="text-right" id="activeusers">
                                <span class="data"><?php echo $count ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Learners
                            </td>
                            <td class="text-center">
                                Total count of learners in the LMS
                            </td>
                            <td class="text-right" id="learners">
                                <span class="data"><?php echo $countusers ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Instructors
                            </td>
                            <td class="text-center">
                               Total count of teachers in the LMS
                            </td>
                            <td class="text-right" id="teachers">
                                <span class="data"><?php echo $countteachers ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Course Completions
                            </td>
                            <td class="text-center">
                                Counts the number of learner completions from all available courses in the system
                            </td>
                            <td class="text-right" id="coursecompletions">
                                <span class="data"><?php echo $content ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-left">
                                Enrollments
                            </td>
                            <td class="text-center">
                                Counts the number of learners enrolled in the course 3
                            </td>
                            <td class="text-right" id="enrollments">
                                <span class="data"><?php echo $countenrolls ?></span>
                            </td>
                        </tr>
                       
                    </tbody>
                </table>
            </div>
        </div>
        <div class="visual col-12">
            <p class="visual-head bold">
               Site visits
            </p>
            <p> Get todays site visit count</p>
            <div id="sitevisits" class=" font-size-30 font-weight-600 w-full">
                                <div class="data"><?php echo $sitevisits ?></div>
                            </div>
        </div>
    </div>
</div>
<p></p>     
<div class="funfacts-area bg-primary text-white pt-100 pb-70">
    <div class="container">
        <div class="section-title">
            
            <h2>FUN FACTS</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-sm-3 col-md-3 col-6">
                <div class="single-funfacts-box bg-success text-white">
                    <h3><span class="odometer" data-count="1926"></span>%</h3>
                    <p>Get todays site visit count</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-6">
                <div class="single-funfacts-box bg-success">
                    <h3><span class="odometer" data-count="3279"></span>%</h3>
                    <p>Get todays Enrolled Learners</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-6">
                <div class="single-funfacts-box bg-success">
                    <h3><span class="odometer" data-count="25"></span>%</h3>
                    <p>Get todays registration count</p>
                </div>
            </div>
            <div class="col-lg-3 col-sm-3 col-md-3 col-6">
                <div class="single-funfacts-box bg-success">
                    <h3><span class="odometer" data-count="99"></span><span class="sign">%</span></h3>
                    <p>Get todays module completion count</p>
                </div>
            </div>
        </div>
    </div>
    <div class="lines">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
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



                         



 
   <p></p>
  
