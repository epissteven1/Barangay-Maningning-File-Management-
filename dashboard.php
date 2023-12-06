<?php include 'idk.php';
include 'document_counts.php'; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="stylesheet" href="user_styles/dash.css">
</head>

<body>


  <div class="app-container">
    <div class="app-header">
      <div class="app-header-left">
        <p class="app-name">Dashboard</p>
      </div>
      <div class="app-header-right">
        <button class="mode-switch" title="Switch Theme">
          <svg class="moon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" width="24" height="24" viewBox="0 0 24 24">
            <defs></defs>
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"></path>
          </svg>
        </button>
        <button class="add-btn" title="Add New Project">
          <svg class="btn-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-plus">
            <line x1="12" y1="5" x2="12" y2="19" />
            <line x1="5" y1="12" x2="19" y2="12" />
          </svg>
        </button>
        <button class="notification-btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="feather feather-bell">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
          </svg>
        </button>

        
                          <?php
                      $sql = "SELECT * FROM applicants WHERE applicant_id = '$id'";
                          $result = mysqli_query($conn, $sql);
                          $row = mysqli_fetch_assoc($result);
                          ?>
        <button class="profile-btn">
        <img class="profile-picture" src="<?php echo $row['applicant_profile']; ?>"alt="A profile picture">
         <span><?php echo $row['fullname']; ?></span>
        </button>
        </div>
      </div>
     
      
      <div class="projects-section">
        <div class="projects-section-header">
          <p> Barangay "Maningning"  </p>
                      <?php
            // Return the current server date and time
                      echo date("Y-m-d H:i:s");
                      ?>
                    </div>
        <div class="projects-section-line">
          <div class="projects-status">
            <div class="item-status">
              <span class="status-number">45</span>
              <button class="stats">Issue Certificate</button>
            </div>
          
          </div>
         <div class="view-actions">
            <button class="view-btn list-view" title="List View">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-list">
                <line x1="8" y1="6" x2="21" y2="6" />
                <line x1="8" y1="12" x2="21" y2="12" />
                <line x1="8" y1="18" x2="21" y2="18" />
                <line x1="3" y1="6" x2="3.01" y2="6" />
                <line x1="3" y1="12" x2="3.01" y2="12" />
                <line x1="3" y1="18" x2="3.01" y2="18" />
              </svg>
            </button>
            <button class="view-btn grid-view active" title="Grid View">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-grid">
                <rect x="3" y="3" width="7" height="7" />
                <rect x="14" y="3" width="7" height="7" />
                <rect x="14" y="14" width="7" height="7" />
                <rect x="3" y="14" width="7" height="7" />
              </svg>
            </button>
          </div>
        </div>
        <div class="project-boxes jsGridView">
          <div class="project-box-wrapper">
            <div class="project-box" style="background-color: #e8e4c9;">
              <div class="project-box-header">
                              <?php
                    // Return the current server date and time
                    echo date("Y-m-d ");
                    ?>
                <div class="more-wrapper">
                  <button class="project-btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="project-box-content-header">
                <p class="box-content-header">Certificate</p>
                <p class="box-content-subheader">Certificate of Residency</p>
                <p class="box-content-subheader">Issue barangay clearance</p>
                <p class="box-content-subheader">Issue barangay ID</p>
              </div>
              
              <div class="box-progress-wrapper">
                <p class="box-progress-header">Progress</p>
                <div class="box-progress-bar">
                  <span class="box-progress" style="width: 60%; background-color:  #34c471"></span>
                </div>
                <p class="box-progress-percentage">60%</p>
              </div>
              <div class="project-box-footer">
                <div class="participants">
                  <img
                    src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
                    alt="participant">
                  <img
                    src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTB8fG1hbnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
                    alt="participant">
                  <button class="add-participant" style="color: #ff942e;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <path d="M12 5v14M5 12h14" />
                    </svg>
                  </button>
                </div>
                <div class="days-left" style="color: #ff942e;">
                  2 Days Left
                </div>
              </div>
            </div>
          </div>
          <div class="project-box-wrapper">
            <div class="project-box" style="background-color: #e8e4c9;">
              <div class="project-box-header">
              <?php
// Return the current server date and time
echo date("Y-m-d ");
?>
                <div class="more-wrapper">
                  <button class="project-btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="project-box-content-header">
              <p class="box-content-header">TotalDocument</p>
              <p><?php echo getTotalDocumentCount($conn); ?></p>
      
             
              </div>

              
            </div>
          </div>
          <div class="project-box-wrapper">
            <div class="project-box" style="background-color: #e8e4c9;">
              <div class="project-box-header">
                    <?php
                    // Return the current server date and time
                    echo date("Y-m-d ");
                    ?>
                  <div class="more-wrapper">
                  <button class="project-btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="project-box-content-header">
                
         
            
            <div class="status">
                <div>
                
                    <h3>Total Residents</h3>
                    <p>500</p>
                </div>
               
            </div>
            
        </div>
                <div class="box-progress-bar">
                  <span class="box-progress" style="width: 80%; background-color: #34c471"></span>
                </div>
                <p class="box-progress-percentage">80%</p>
              </div>
              <div class="project-box-footer">
                <div class="participants">
                  <img
                    src="https://images.unsplash.com/photo-1587628604439-3b9a0aa7a163?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MjR8fHdvbWFufGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
                    alt="participant">
                  <img
                    src="https://images.unsplash.com/photo-1596815064285-45ed8a9c0463?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1215&q=80"
                    alt="participant">
                  <button class="add-participant" style="color: #096c86;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <path d="M12 5v14M5 12h14" />
                    </svg>
                  </button>
                </div>
                
              </div>
            </div>
          </div>
          <div class="project-box-wrapper">
            <div class="project-box" style="background-color: #e8e4c9;">
              <div class="project-box-header">
                <span>April 11, 2023</span>
                <div class="more-wrapper">
                  <button class="project-btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="project-box-content-header">
                <p class="box-content-header">UI Development</p>
                <p class="box-content-subheader">Prototyping</p>
              </div>
              <div class="box-progress-wrapper">
                <p class="box-progress-header">Progress</p>
                <div class="box-progress-bar">
                  <span class="box-progress" style="width: 20%; background-color: #34c471"></span>
                </div>
                <p class="box-progress-percentage">20%</p>
              </div>
              <div class="project-box-footer">
                <div class="participants">
                  <img
                    src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
                    alt="participant">
                  <img
                    src="https://images.unsplash.com/photo-1587628604439-3b9a0aa7a163?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MjR8fHdvbWFufGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
                    alt="participant">
                  <button class="add-participant" style="color: #df3670;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <path d="M12 5v14M5 12h14" />
                    </svg>
                  </button>
                </div>
                <div class="days-left" style="color: #df3670;">
                  2 Days Left
                </div>
              </div>
            </div>
          </div>
          <div class="project-box-wrapper">
            <div class="project-box" style="background-color: #e8e4c9;">
              <div class="project-box-header">
                          <span>             
                             <?php
                    // Return the current server date and time
                    echo date("Y-m-d ");
                    ?>
                          </span>
                <div class="more-wrapper">
                  <button class="project-btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="project-box-content-header">
                <p class="box-content-header">Data Analysis</p>
                <p class="box-content-subheader">Prototyping</p>
              </div>
              <div class="box-progress-wrapper">
                <p class="box-progress-header">Progress</p>
                <div class="box-progress-bar">
                  <span class="box-progress" style="width: 60%; background-color: #34c471"></span>
                </div>
                <p class="box-progress-percentage">60%</p>
              </div>
              <div class="project-box-footer">
                <div class="participants">
                  <img
                    src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
                    alt="participant">
                  <img
                    src="https://images.unsplash.com/photo-1503023345310-bd7c1de61c7d?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTB8fG1hbnxlbnwwfHwwfA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=900&q=60"
                    alt="participant">
                  <button class="add-participant" style="color: #34c471;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <path d="M12 5v14M5 12h14" />
                    </svg>
                  </button>
                </div>
                <div class="days-left" style="color: #34c471;">
                  2 Days Left
                </div>
              </div>
            </div>
          </div>
          <div class="project-box-wrapper">
            <div class="project-box" style="background-color:  #e8e4c9;">
              <div class="project-box-header">
                       <span>           
                     <?php
                    // Return the current server date and time
                    echo date("Y-m-d ");
                    ?>
                        </span>
                <div class="more-wrapper">
                  <button class="project-btn-more">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1" />
                      <circle cx="12" cy="5" r="1" />
                      <circle cx="12" cy="19" r="1" />
                    </svg>
                  </button>
                </div>
              </div>
              <div class="project-box-content-header">
                <p class="box-content-header">Web Designing</p>
                <p class="box-content-subheader">Prototyping</p>
              </div>
              <div class="box-progress-wrapper">
                <p class="box-progress-header">Progress</p>
                <div class="box-progress-bar">
                  <span class="box-progress" style="width: 40%; background-color: #4067f9"></span>
                </div>
                <p class="box-progress-percentage">40%</p>
              </div>
              <div class="project-box-footer">
                <div class="participants">
                  <img
                    src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
                    alt="participant">
                  <img
                    src="https://images.unsplash.com/photo-1583195764036-6dc248ac07d9?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=2555&q=80"
                    alt="participant">
                  <button class="add-participant" style="color: #4067f9;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-plus">
                      <path d="M12 5v14M5 12h14" />
                    </svg>
                  </button>
                </div>
                <div class="days-left" style="color: #4067f9;">
                  2 Days Left
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     
         

        <!-- Include your script with initializeDashboardJS -->
<script src="../Barangay-Maningning-File-Management-/scripts/initializeDashboardJS.js"></script>

  <!--! Adding JavaScript -->
  <script src="script.js"></script>

</body>

</html>