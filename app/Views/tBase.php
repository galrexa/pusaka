<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=isset($title)?$title:'Page'?></title>
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendors/fontawesome/css/all.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
    <script src="<?=base_url('assets/js/jquery-3.7.1.min.js')?>"></script>
    <script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('assets/js/custom.js')?>"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                "Key": "<?=session()->get('key')?>",
                "User": '<?=session()->get('id')?>',
                "Token": '<?=session()->get('token')?>',
            }
        });
    </script>
</head>
<body>

    <!-- MODERN NAVBAR HEADER -->
    <?=view('tBaseHeader')?>
    
    <!-- Include Alert & Toast Helper -->
    <?=view('tBaseAlert')?>

    <!-- MODERN SIDEBAR -->
    <?php 
        if(session()->get('id_app')==2){
            echo view('Kepegawaian/tBaseSidebar');
        }
        if(session()->get('id_app')==3){
            echo view('Presensi/tBaseSidebar');
        }
        // if(session()->get('id_app')==4){
        //     echo view('Cuti/tBaseSidebar');
        // }
        // if(session()->get('id_app')==5){
        //     echo view('Persuratan/tBaseSidebar');
        // }
    ?>

    <!-- Main Content with Modern Styling -->
    <div class="main-content" id="mainContent">
        <?php if(session()->get('message')){?>
            <!-- MODERN ALERT FLASHDATA -->
            <div class="alert alert-info alert-dismissible fade show" id="flashdata_message" 
                 style="border-radius: var(--radius-base); 
                        box-shadow: var(--shadow-section); 
                        border-left: 4px solid var(--info-color);
                        background: linear-gradient(90deg, rgba(52, 152, 219, 0.1) 0%, rgba(255, 255, 255, 0.95) 100%);">
                <i class="fa fa-exclamation-circle me-2"></i> 
                <strong><?=session()->get('message')?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php }?>
        
        <?php 
            // LOAD VIEW PAGE
            if(isset($page) && file_exists(APPPATH.'Views/'.$page.'.php'))
            {
                echo view($page);
            }else{
                echo '<div class="modern-card">
                        <div class="modern-card-body text-center py-5">
                            <i class="fa fa-exclamation-triangle" style="font-size: 4rem; color: var(--warning-color); margin-bottom: 1rem;"></i>
                            <h3 class="text-warning">Page Not Found</h3>
                            <p class="text-muted">The requested page could not be found.</p>
                        </div>
                      </div>';
            }
        ?>
    </div>

    <!-- MODERN MODAL -->
    <div class="modal fade" tabindex="-1" id="modal1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: var(--radius-lg); border: none; overflow: hidden;">
                <div class="modal-header" id="modal1_header" 
                     style="background: var(--primary-gradient); 
                            border: none; 
                            padding: var(--space-xl);">
                    <h5 class="modal-title" style="color: white; font-weight: var(--font-semibold); margin: 0;">
                        <i class="fas fa-info-circle me-2"></i>Information
                    </h5>
                    <button type="button" 
                            class="btn-close btn-close-white" 
                            data-bs-dismiss="modal" 
                            aria-label="Close"
                            style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" id="modal1_body" 
                     style="padding: var(--space-2xl); 
                            background: var(--background-white);
                            font-size: var(--font-base);
                            color: var(--text-medium);">
                    <p>Modal body text goes here.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script type="text/javascript">
        function showModalInfo(message, headers=1)
        {
            $('#modal1').modal('show')
            if(headers==0){
                $('#modal1_header').hide()
            }else{
                $('#modal1_header').show()
            }
            $('#modal1_body').html(message)
        }

        // Show dropdown on hover
        $('.dropdown').mouseover(function () {
            if($('.navbar-toggler').is(':hidden')) {
                $(this).addClass('show').attr('aria-expanded', 'true');
                $(this).find('.dropdown-menu').addClass('show');
            }
        }).mouseout(function () {
            if($('.navbar-toggler').is(':hidden')) {
                $(this).removeClass('show').attr('aria-expanded', 'false');
                $(this).find('.dropdown-menu').removeClass('show');
            }
        });

        // Go to the parent link on click
        $('.dropdown > a').click(function(){
            location.href = this.href;
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle with Modern Animation
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            if(sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('sidebar-hidden');
                    mainContent.classList.toggle('expanded');
                });
            }

            const currentLocation = window.location.pathname;
            const queryString = window.location.search;
            const currentLink = currentLocation + queryString;
            const urlParams = new URLSearchParams(queryString);
            
            function setActiveMenu() {
                const navLinks = document.querySelectorAll('.sidebar .sidebar-link');
                navLinks.forEach(link => {
                    const linkPath = link.getAttribute('href');
                    link.classList.remove('active');
                    
                    if (linkPath && linkPath !== '/' && currentLink.includes(linkPath.replace('<?=base_url()?>', ''))) {
                        link.classList.add('active');
                        console.log('CurrentLink::',currentLink,' href::',linkPath,' (ACTIVE)')
                        
                        const parent = link.closest('.submenu');
                        if (parent) {
                            parent.classList.add('show');
                            const parentToggle = document.querySelector(`[href="#${parent.id}"]`);
                            if (parentToggle) {
                                parentToggle.setAttribute('aria-expanded', 'true');
                                parentToggle.classList.add('active');
                            }
                        }
                    }
                });
            }
            
            const dropdownToggles = document.querySelectorAll('.sidebar-dropdown');
            dropdownToggles.forEach(function(toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    const dropdown = this.nextElementSibling;
                    const arrow = this.querySelector('.dropdown-arrow');
                    
                    document.querySelectorAll('.submenu').forEach(function(item) {
                        if (item !== dropdown) {
                            item.classList.remove('show');
                            const itemArrow = item.previousElementSibling.querySelector('.dropdown-arrow');
                            if(itemArrow) itemArrow.classList.remove('active');
                        }
                    });
                    
                    dropdown.classList.toggle('show');
                    arrow.classList.toggle('active');
                });
            });
            
            // Auto detect if this is the index page
            if (currentLink === '/' || currentLink.endsWith('index.php')) {
                const dashboardLink = document.querySelector('a[href="/index.php"]');
                if (dashboardLink) {
                    dashboardLink.classList.add('active');
                }
            } else {
                setActiveMenu();
            }

            // Auto-hide flashdata after 5 seconds with fade effect
            const flashdata = document.getElementById('flashdata_message');
            if(flashdata) {
                setTimeout(function() {
                    flashdata.style.transition = 'opacity 0.5s ease';
                    flashdata.style.opacity = '0';
                    setTimeout(function() {
                        flashdata.remove();
                    }, 500);
                }, 5000);
            }
        })

        // Aktivasi tooltips dengan modern styling
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                template: '<div class="tooltip" role="tooltip" style="border-radius: var(--radius-sm);"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="border-radius: var(--radius-sm); padding: var(--space-sm) var(--space-md);"></div></div>'
            })
        })
    </script>
    
    <!-- JAVASCRIPT -->
    <?=view('tBaseJavascript')?>
</body>
</html>
