<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../images/face1.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['user_name']; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <?php 

            if ($_SESSION['user_role'] != "User") {
                
            
             ?>
            <li class="active" >
                <a  href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-book"></i></i> <span>Manage Bill</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu" style="display: block;">

            <?php } ?>
                    <li><a href="../file_open/file.php"><i class="fa fa-arrow-right"></i>Bill List</a></li>

                    <li><a href="../file_open/file_add.php"><i class="fa fa-plus" aria-hidden="true"></i>New Bill</a></li>

            <?php 

            if ($_SESSION['user_role'] != "User") {
                
            
             ?>
                    <li><a href="../file_open/particular_add.php"><i class="fa fa-arrow-right"></i>Manage Bill Items</a></li>
                    <li><a href="../file_open/expenses_add.php"><i class="fa fa-arrow-right"></i>Expense Items</a></li>
                    <li><a href="../file_open/profit_loss.php"><i class="fa fa-line-chart"></i></span>Profit Loss</a></li>
                    <li><a href="../file_open/bill_statement.php"><i class="fa fa-line-chart"></i></span>Bill Statement</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-handshake-o" aria-hidden="true"></i> <span>Requisition</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="../requisition/requisition_list.php"><i class="fa fa-circle-o"></i>Manage Requisition</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Marketing</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="../marketing/marketing_zone.php"><i class="fa fa-circle-o"></i>Marketing Zone</a></li>
                    <li class=""><a href="../marketing/marketing_sector.php"><i class="fa fa-circle-o"></i>Marketing Sector</a></li>
                    <li class=""><a href="../marketing/marketing_company.php"><i class="fa fa-circle-o"></i>Marketing Company</a></li>
                    <li class=""><a href="../marketing/company_visit.php"><i class="fa fa-circle-o"></i>Company visit</a></li>
                    <li class=""><a href="../marketing/marketing_company_visiting_report.php"><i class="fa fa-line-chart"></i>Marketing Visiting Report</a></li>
                    <li class=""><a href="../marketing/monthly_employee_comments.php"><i class="fa fa-circle-o"></i>Monthly Employee Comments</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="../accounts/index.php">
                    <i class="fa fa-money" aria-hidden="true"></i> <span>Accounts</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="../accounts/ledger_category.php"><i class="fa fa-circle-o"></i>Ledger Category</a></li>
                    <li class=""><a href="../accounts/ledger_head.php"><i class="fa fa-circle-o"></i>Ledger Head</a></li>
                    <li class=""><a href="../accounts/ledgerentry.php"><i class="fa fa-circle-o"></i>Ledger Entry</a></li>
                </ul>
            </li>
            <li class="treeview ">
                <a href="#">
                    <i class="fa fa-laptop"></i> <span>Admin Setup</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/location.php"><i class="fa fa-arrow-right"></i>Location</a>
                    </li>
                    <li><a href="../admin/port.php"><i class="fa fa-arrow-right"></i>Port</a></li>
                    <li><a href="../admin/country.php"><i class="fa fa-arrow-right"></i>Country</a></li>
                    <li><a href="../admin/file_status.php"><i class="fa fa-arrow-right"></i>File Status</a></li>
                    <li><a href="../admin/size.php"><i class="fa fa-arrow-right"></i>Size</a></li>
                    <li><a href="../admin/zone.php"><i class="fa fa-arrow-right"></i>Zone</a></li>
                    <li><a href="../admin/gate.php"><i class="fa fa-arrow-right"></i>Gate</a></li>
                    <li><a href="../admin/unit.php"><i class="fa fa-arrow-right"></i>Unit</a></li>
                    <li><a href="../accounts/lc_type.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    LC Type</a></li>
                    <li><a href="../accounts/expense_status.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Expense Status</a></li>
                    <li><a href="../accounts/payment_type.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Payment Type</a></li>
                    <li><a href="../accounts/payment_status.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Payment Status</a></li>
                    <li><a href="../accounts/currency.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Currency</a></li>
                <!--    <li><a href="../bank/bank_type.php"><i class="fa fa-arrow-right"></i>-->
                <!--Bank Type</a></li>-->
                    <!--<li ><a href="../bank/branch.php"><i class="fa fa-plus" aria-hidden="true"></i>Branch</a></li>-->
                </ul>
            </li>
            <!-- <li class="treeview ">
                <a href="#">
                    <i class="fa fa-th-large"></i> <span>Access Control</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../admin/user_role.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    User Role</a></li>
                    <li><a href="../admin/role_map.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Role Map</a></li>
                    <li><a href="../admin/access_control.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Access Control</a></li>
                    <li><a href="../admin/page_access.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Page Access</a></li>
                    <li><a href="../admin/page_setup.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Page Setup</a></li>
                </ul>
            </li> -->
            <!-- <li>
                <a href="../bank/bank.php">
                    <i class="fa fa-user-circle-o"></i> <span>Bank</span>
                  </span>
                </a>
            </li> -->
            <li>
                <a href="../admin/customer.php">
                    <i class="fa fa-user" aria-hidden="true"></i> <span>Clients</span>
                  </span>
                </a>
            </li>
            <li>
                <a href="../admin/employee.php"><i class="fa fa-user" aria-hidden="true"></i> <span>Employees</span></a>
            </li>
            <li>
                <a href="../admin/user.php"><i class="fa fa-user" aria-hidden="true"></i> <span>Manage Users</span></a>
            </li>  
              <?php 

            if ($_SESSION['user_role'] == "Master User") {
                
            
             ?>
            <li>
                <a href="../dadbbkup.php"><i class="fa fa-download" aria-hidden="true"></i> <span>Data Backup</span></a>
            </li>  
            
            <?php 
            }
            }
            ?>   
</ul>    </section>
<!-- /.sidebar -->
</aside>