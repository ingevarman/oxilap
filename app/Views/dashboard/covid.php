<?= $this->extend('layouts/admin') ?>

<?= $this->section('pagestyles') ?>
<!-- START: Page CSS-->
<link rel="stylesheet"  href="<?php echo base_url('dist/vendors/chartjs/Chart.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/morris/morris.css'); ?>"> 
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/weather-icons/css/pe-icon-set-weather.min.css'); ?>"> 
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/chartjs/Chart.min.css'); ?>"> 
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/starrr/starrr.css'); ?>"> 
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/fontawesome/css/all.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/ionicons/css/ionicons.min.css'); ?>"> 
<link rel="stylesheet" href="<?php echo base_url('dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css'); ?>">
<!-- END: Page CSS-->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- START: Breadcrumbs-->
<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-12 col-md-6 col-lg-7  align-self-center  my-4">
                <div class="sub-header align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100"><h4 class="mb-0">Dashboard</h4> <p>Welcome to liner admin panel</p>
                        <a href="#" class="btn btn-primary">Get Started <i class="fas fa-arrow-right"></i></a>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-5 my-4">
                <div id="flot-stacking" class="header-chart"></div>
            </div>
        </div>

    </div>
</div>
<!-- END: Breadcrumbs-->

<!-- START: Card Data-->
<div class="row">
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
            <div class="card-body text-info border-bottom border-info border-w-5">
                <h2 class="text-center">3,740,591</h2>
                <h6 class="text-center">Coronavirus Cases</h6>       
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
            <div class="card-body text-success border-bottom border-success border-w-5">
                <h2 class="text-center">1,247,377</h2>
                <h6 class="text-center">Recovered</h6>       
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4 mt-3">
        <div class="card">
            <div class="card-body text-danger border-bottom border-danger border-w-5">
                <h2 class="text-center">258,509</h2>
                <h6 class="text-center">Deaths</h6>       
            </div>
        </div>
    </div>


    <div class="col-12 col-lg-8  mt-3">
        <div class="card">                           
            <div class="card-content">
                <div class="card-body">
                    <canvas id="chartjs_corona"></canvas>

                </div>
            </div>
        </div>
    </div>     
    <div class="col-lg-4 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h6 class="card-title">Cases by Country</h6>
            </div>
            <div class="card-content">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless pick-table mb-0">
                            <thead>
                                <tr>
                                    <th>Country</th>
                                    <th class="text-right">Active Cases</th>
                                    <th class="text-right">Death</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>USA</td>
                                    <td class="text-right">964,817</td>
                                    <td class="text-right">72,275</td>
                                </tr>
                                <tr>
                                    <td>Canada</td>
                                    <td class="text-right">31,010</td>
                                    <td class="text-right">4,043</td>
                                </tr>
                                <tr>
                                    <td>Mexico</td>
                                    <td class="text-right">6,708</td>
                                    <td class="text-right">2,507</td>
                                </tr>
                                <tr>
                                    <td>Dominican Republic</td>
                                    <td class="text-right">6,221</td>
                                    <td class="text-right">354</td>
                                </tr>
                                <tr>
                                    <td>Panama</td>
                                    <td class="text-right">6,490</td>
                                    <td class="text-right">210</td>
                                </tr>
                                <tr>
                                    <td>Cuba</td>
                                    <td class="text-right">5,345</td>
                                    <td class="text-right">323</td>
                                </tr>
                                <tr>
                                    <td>Honduras</td>
                                    <td class="text-right">5,555</td>
                                    <td class="text-right">657</td>
                                </tr>
                                <tr>
                                    <td>Guatemala</td>
                                    <td class="text-right">6,490</td>
                                    <td class="text-right">234</td>
                                </tr>
                                <tr>
                                    <td>Costa Rica</td>
                                    <td class="text-right">3,477</td>
                                    <td class="text-right">123</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12  col-md-3 mt-3">
        <div class="card overflow-hidden"> 
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h6 class="card-title">Symptoms of COVID-19</h6>
            </div>
            <div class="card-content">
                <div class="card-body p-0">
                    <ul class="list-group list-unstyled">
                        <li class="py-3 px-4 border-bottom zoom">                                           
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Fever <i class="fas fa-arrow-right ml-auto my-auto"></i></a> 
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">  
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Tiredness <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                             
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Dry Cough <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Aches and Pains <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Nasal Congestion<i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Runny Nose <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Sore Throat <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12  col-md-3 mt-3">
        <div class="card overflow-hidden"> 
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h6 class="card-title">Prevention of COVID-19</h6>
            </div>
            <div class="card-content">
                <div class="card-body p-0">
                    <ul class="list-group list-unstyled">
                        <li class="py-3 px-4 border-bottom zoom">                                           
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Stay home <i class="fas fa-arrow-right ml-auto my-auto"></i></a> 
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">  
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Keep a safe distance <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                             
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Wash hands often <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Cover your cough <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Sick? Call the helpline<i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 border-bottom zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Cover your nose <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>
                        <li class="py-3 px-4 zoom">      
                            <a href="#" class="mb-0 font-w-600 d-flex w-100 color-primary">Follow local health authority <i class="fas fa-arrow-right ml-auto my-auto"></i></a>                                                
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h6 class="card-title">Q&A on coronaviruses (COVID-19)</h6>
            </div>
            <div class="card-body">
                <div class="card-content">
                    <div id="accordion2" class="accordion-alt" role="tablist">
                        <div class="mb-2">
                            <h6 class="mb-0">
                                <a class="d-block border" data-toggle="collapse" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                    What is a coronavirus?
                                </a>
                            </h6>
                            <div id="collapse4" class="collapse show" role="tabpanel" data-parent="#accordion2">
                                <div class="card-body">
                                    <p>
                                        Coronaviruses are a large family of viruses which may cause illness in animals or humans.  In humans, several coronaviruses are known to cause respiratory infections ranging from the common cold to more severe diseases such as Middle East Respiratory Syndrome (MERS) and Severe Acute Respiratory Syndrome (SARS). The most recently discovered coronavirus causes coronavirus disease COVID-19. 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <h6 class="mb-0">
                                <a class="collapsed redial-dark d-block border redial-border-light" data-toggle="collapse" href="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    What is COVID-19?
                                </a>
                            </h6>
                            <div id="collapse5" class="collapse" role="tabpanel"  data-parent="#accordion2">
                                <div class="card-body">
                                    <p>COVID-19 is the infectious disease caused by the most recently discovered coronavirus. This new virus and disease were unknown before the outbreak began in Wuhan, China, in December 2019. COVID-19 is now a pandemic affecting many countries globally.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0">
                                <a class="collapsed redial-dark d-block border redial-border-light" data-toggle="collapse" href="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    What are the symptoms of COVID-19?
                                </a>
                            </h6>
                            <div id="collapse6" class="collapse" role="tabpanel" data-parent="#accordion2">
                                <div class="card-body">
                                    <p> The most common symptoms of COVID-19 are fever, dry cough, and tiredness. Other symptoms that are less common and may affect some patients include aches and pains, nasal congestion, headache, conjunctivitis, sore throat, diarrhea, loss of taste or smell or a rash on skin or discoloration of fingers or toes. These symptoms are usually mild and begin gradually. Some people become infected but only have very mild symptoms.
                                    </p>
                                    <p>
                                        Most people (about 80%) recover from the disease without needing hospital treatment. Around 1 out of every 5 people who gets COVID-19 becomes seriously ill and develops difficulty breathing. Older people, and those with underlying medical problems like high blood pressure, heart and lung problems, diabetes, or cancer, are at higher risk of developing serious illness.  However, anyone can catch COVID-19 and become seriously ill.  People of all ages who experience fever and/or  cough associated withdifficulty breathing/shortness of breath, chest pain/pressure, or loss of speech or movement should seek medical attention immediately. If possible, it is recommended to call the health care provider or facility first, so the patient can be directed to the right clinic.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- END: Card DATA-->   
<?= $this->endSection() ?>

<?= $this->section('pagescript') ?>
<!-- START: Page JS-->
<script src="<?php echo base_url('dist/vendors/raphael/raphael.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/morris/morris.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/chartjs/Chart.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/starrr/starrr.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.canvaswrapper.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.colorhelpers.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.saturated.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.browser.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.drawSeries.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.uiConstants.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.legend.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-flot/jquery.flot.pie.js'); ?>"></script>        
<script src="<?php echo base_url('dist/vendors/chartjs/Chart.min.js'); ?>"></script>  
<script src="<?php echo base_url('dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors/apexcharts/apexcharts.min.js'); ?>"></script>        
<script src="<?php echo base_url('dist/js/home.script.js'); ?>"></script>
<!-- END: Page JS-->
<?= $this->endSection() ?>