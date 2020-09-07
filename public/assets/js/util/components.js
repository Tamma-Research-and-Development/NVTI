export let components = {
    nav: {
        admin: `
            <!-- Home -->
            <div class=" sidebar-nav-btn mb-3 workspace-nav-link nav-btn-md admin-nav-btn-1" data-target-view="admin-home">
                <div class="text-center mb-1">
                    <i class="fal fa-home fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>Home</h6>
                </div>
            </div>
            <!-- Account -->
            <div class=" regular-account-pwdRest-btn mb-3 workspace-nav-link nav-btn-md " data-target-view="settings">
                <div class="text-center mb-1">
                    <i class="fal fa-user-circle  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>account</h6>
                </div>
            </div>
            <!-- Settings -->
            <div class=" sidebar-nav-btn mb-3 workspace-nav-link  nav-btn-md " data-target-view="settings">
                <div class="text-center mb-1">
                    <i class="fal fa-cog fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>Settings</h6>
                </div>
            </div>
            <!-- Exit -->
            <div class=" sidebar-nav-btn mb-3 workspace-nav-link  nav-btn-md " data-target-view="Exit">
                <div class="text-center mb-1">
                    <i class="fal fa-sign-out-alt fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>signout</h6>
                </div>
            </div>
        `,
        teacher: `
            <!-- home -->
            <div class="sidebar-nav-btn student-nav-btn mb-3 workspace-nav-link" data-target-view="teacher-home">
                <div class="text-center mb-1">
                    <i class="fal fa-home  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>home</h6>
                </div>
            </div>
            <!-- reports -->
            <div class=" sidebar-nav-btn student-nav-btn mb-3 workspace-nav-link p-2" data-target-view="teacher-reports">
                <div class="text-center mb-1">
                    <i class="fal fa-chart-pie  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>reports</h6>
                </div>
            </div>
            <!-- Account -->
            <div class="student-nav-btn regular-account-pwdRest-btn mb-3 workspace-nav-link" data-target-view="settings">
                <div class="text-center mb-1">
                    <i class="fal fa-user-circle  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>account</h6>
                </div>
            </div>
            <!-- Exit -->
            <div class=" sidebar-nav-btn student-nav-btn mb-3 workspace-nav-link " 
                data-target-view="Exit">
                <div class="text-center mb-1">
                    <i class="fal fa-sign-out-alt  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>signout</h6>
                </div>
            </div>
        `,
        student: `
            <!-- home -->
            <div class="sidebar-nav-btn student-nav-btn mb-3 workspace-nav-link" data-target-view="studentHome">
                <div class="text-center mb-1">
                    <i class="fal fa-home  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>home</h6>
                </div>
            </div>
            <!-- Classroom -->
            <div class=" sidebar-nav-btn student-nav-btn mb-3 workspace-nav-link p-2" data-target-view="student-classroom">
                <div class="text-center mb-1">
                    <i class="fal fa-users-class  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>class</h6>
                </div>
            </div>
            <!-- Account -->
            <div class="student-nav-btn regular-account-pwdRest-btn mb-3 workspace-nav-link" data-target-view="settings">
                <div class="text-center mb-1">
                    <i class="fal fa-user-circle  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>account</h6>
                </div>
            </div>
            <!-- Exit -->
            <div class=" sidebar-nav-btn student-nav-btn mb-3 workspace-nav-link " 
                data-target-view="Exit">
                <div class="text-center mb-1">
                    <i class="fal fa-sign-out-alt  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>signout</h6>
                </div>
            </div>
        `,
        admission: `
            <!-- Home -->
            <div class=" sidebar-nav-btn mb-3 workspace-nav-link nav-btn-sm admin-nav-btn-1" data-target-view="admission-home">
                <div class="text-center mb-1">
                    <i class="fal fa-home fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>Home</h6>
                </div>
            </div>
            <!-- Account -->
            <div class=" regular-account-pwdRest-btn mb-3 nav-btn-sm workspace-nav-link  admin-nav-btn-1" data-target-view="">
                <div class="text-center mb-1">
                    <i class="fal fa-user-circle  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>account</h6>
                </div>
            </div>
            <!-- Exit -->
            <div class=" sidebar-nav-btn mb-3 workspace-nav-link nav-btn-sm    " data-target-view="Exit">
                <div class="text-center mb-1">
                    <i class="fal fa-sign-out-alt fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>signout</h6>
                </div>
            </div>
        `,
        finance: `
            <!-- Home -->
            <div class=" sidebar-nav-btn mb-3 workspace-nav-link nav-btn-sm admin-nav-btn-1" data-target-view="finance-home">
                <div class="text-center mb-1">
                    <i class="fal fa-home fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>Home</h6>
                </div>
            </div>
            <!-- Account -->
            <div class=" regular-account-pwdRest-btn mb-3 nav-btn-sm workspace-nav-link " data-target-view="">
                <div class="text-center mb-1">
                    <i class="fal fa-user-circle  fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>account</h6>
                </div>
            </div>
            <!-- Exit -->
            <div class=" sidebar-nav-btn mb-3 nav-btn-sm workspace-nav-link  " data-target-view="Exit">
                <div class="text-center mb-1">
                    <i class="fal fa-sign-out-alt fa-2x text-white sidebar-icon"></i>
                </div>
                <div class="text-center text-uppercase p-0">
                    <h6>signout</h6>
                </div>
            </div>
        `
    }, 
    homepage: {
        about: `
            <div class="mb-4">
                <!-- emp info -->
                <div class=" container">
                    <img src="../assets/media/img/" class="info-modal-img">
                    <div class="col text-center">
                        <i class="fad fa-phone"></i> <a class="about-contact-mobile" href="tel:"></a><br>
                        <i class="fad fa-envelope"></i> <a class="about-contact-email" href="mailto:"></a>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-4">
                <h6 class="text-center font-weight-bold">MOTTO</h6>
                <blockquote class="text-center">"<i class="about-school-motto">We Build Minds</i>"</blockquote>
            </div>
            <!--  -->
            <div class="accordion mb-4" id="accordionExample">
                <!-- MISSION STATEMENT -->
                <div class="card">
                    <div class="card-header p-0" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-danger btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            MISSION STATEMENT
                            </button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body about-school-mission-statement">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <!-- VISION -->
                <div class="card">
                    <div class="card-header p-0" id="headingTwo">
                        <button class="btn btn-danger btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        VISION
                        </button>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body about-school-vision">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <!-- HISTORY -->
                <div class="card">
                    <div class="card-header p-0" id="headingThree">
                        <button class="btn btn-danger btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        HISTORY
                        </button>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body about-school-history">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                    </div>
                </div>
            </div>
            <!-- staff image card -->
            <div class="col md-4">
                <h6 class="text-center font-weight-bold">OUR EXPERIENCED STAFFS</h6>
                <div class="col">
                    <div class="row about-staff-list">
                    </div>
                </div>
            </div>
        `,
        skipElements: {
            none: "",
            scholarship: `
                <div class="row p-2">
                    <!-- Institution or indivual responsible for fee payment -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 pl-0">
                        <label>Name of Institution or indivual responsible for fee payment: </label>
                        <input type="text" id="scholarship_provider" required class="form-control sleak-input rounded-0">
                        <i class='text-danger'>  * Required</i>
                    </div>
                    <!-- Phone -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5 pl-0">
                        <label>Phone: </label>
                        <input type="text" id="scholarship_provider_phone" required class="form-control sleak-input rounded-0">
                        <i class='text-danger'>  * Required</i>
                    </div>
                    <!-- Email -->
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5 pl-0">
                        <label>Email: </label>
                        <input type="email" id="scholarship_provider_email" class="form-control sleak-input rounded-0">
                        <i class='text-info'> * Optional</i>
                    </div>
                </div>
            `,
            previousVocationSchool: `
                <div class="row p-2">
                    <!-- Institution or indivual responsible for fee payment -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 pl-0">
                        <label>Name of school: </label>
                        <input type="text" id="previous_vocation_school_name" required class="form-control sleak-input rounded-0">
                        <i class='text-danger'>  * Required</i>
                    </div>
                    <!-- Phone -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 pl-0">
                        <label>Location of school: </label>
                        <input type="text" id="previous_vocation_school_Location" required class="form-control sleak-input rounded-0">
                        <i class='text-danger'>  * Required</i>
                    </div>
                </div>
            `
        }
    },
    contactForm: `
        <div class="col">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 pb-2 ">
                    <!-- -->
                    <div class="container col-xl-9 col-lg-9 col-md-10 col-sm-12 col-12  bg-white">
                        <h2 class="text-center pt-5"><span><b>We'd Love To Hear From You!</b> </span></h2>
                        <p class=" text-center lead">Fill out this form and we'll be in touch with you as soon as possible</p>

                        <form class="mt-5" id="contact-form" autocomplete="off">
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label for="">First name</label>
                                    <input type="text" id="feedback-first_name" required class="form-control sleak-input rounded-0" >
                                    <i class='text-danger'> * Required</i>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label for="">Last name</label>
                                    <input type="text" id="feedback-last_name" required class="form-control sleak-input rounded-0" >
                                    <i class='text-danger'> * Required</i>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label for="">Contact (Email)  </label>
                                    <input type="email" id="feedback-email" class="form-control sleak-input rounded-0" >
                                    <i class='text-info'> * Optional</i>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label for="">Contact (Mobile)</label>
                                    <input type="number" id="feedback-mobile" required class="form-control sleak-input rounded-0" >
                                    <i class='text-danger'> * Required</i>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12 mb-2">
                                    <label for="">Message</label>
                                    <textarea  id="feedback-message" required class="form-control sleak-input rounded-0 "rows="5"  ></textarea>
                                    <i class='text-danger'> * Required</i>
                                </div>
                            </div>
                            <!-- -->
                            <div class="notice"></div>
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex justify-content-end mt-4 mb-5">
                                <button type="button" class="btn btn-outline-secondary btn-sm rounded-0 mr-2"  data-dismiss="modal" aria-label="Close"> Cancel </button>
                                <button type="submit" class="btn btn-dark btn-sm rounded-0 contact-form-submit-btn"> Send </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12  bg-dark text-white pb-2" style="position:relative">
                    <div class="p-3">
                        <!-- FAQ -->
                        <div class="mb-5">
                            <h2 class="text-uppercase mb-3"><b>faq</b></h2>
                            <h4 class="mb-3">How do I get on board?</h4>
                            <ol class="pl-3 lead" style="list-style-type:disc">
                                <li class="mb-3"> <i> Click the action button labeled <b>"student"</b> on the homepage</i> </li>
                                <li class="mb-3"> <i> Click the <b>"Create Account"</b> link on the student login page</i> </li>
                                <li class="mb-3"> <i> Review school informationsheet</i> </li>
                                <li class="mb-3"> <i> Provide all required information</i> </li>
                            </ol>
                        </div>

                        <!-- contact -->
                        <div class="">
                            <h3><b>Contact Information</b></h3>
                            <div class="col mt-3 lead">
                                <h5> <i class="fad fa-map-marker-alt text-danger"></i> <span class="help-contact-address">Oldest Congo Town</span></h5>
                                <h5><i class="fad fa-phone text-success"></i> <a class="text-white help-contact-mobile" href="tel:0775714849">0777007009</a></h5>
                                <h5><i class="fad fa-envelope text-warning"></i> <a class="text-white help-contact-email" href="mailto:hopechina@info.com">hopechina@info.com</a></h5>
                            </div>
                        </div>

                        <!-- social -->
                        <div class="help-modal-social-links-wrapper">
                            <h6 class="mt-2 text-uppercase">Follow Us</h6>
                            <div class="social-links">
                                <a href="#"><i class="fab fa-facebook fa-2x text-primary p-2"></i></a>
                                <a href="#"><i class="fab fa-twitter fa-2x text-info p-2"></i></a>
                                <a href="#"><i class="fab fa-google-plus fa-2x text-danger p-2"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    `,
    studentPaymentForm: `
        <span class="rounded-0 text-uppercase" id="exit-payment-form-view">
            <i class="fal fa-arrow-left " id="exit-payment-form-view"></i> Back
        </span>
        <div class="col-12 p-0">
            <div class="row">
                <!-- invoice -->
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 p-3 ">
                    <!-- Summary -->
                    <div class="col-12 p-3 mb-3 text-white shadow rounded" style="background:#3949ab;">
                        <div class="col-12 p-3">
                            <h6 class="text-uppercase mb-4 pl-1 font-weight-bold">Payment Summary</h6>
                            <ol class="p-4 text-uppercase">
                                <li class="">All courses - $100USD</li>
                                <li class="">Breakage fee -  $80USD</li>
                                <li class="">Tissue - $10USD</li>
                                <li class="">Lab fee - $200USD</li>
                            </ol>
                        </div>
                    </div>
                    <!-- Total -->
                    <div class="col-12 p-3 mb-3  text-white bg-success shadow rounded">
                        <div class="col-12 p-3 mb-3">
                            <h6 class="text-uppercase">Total Price</h6>
                            <h2>390 USD</h2>
                            <h2>70, 200 LRD</h2>
                        </div>
                    </div>
                </div>
                <!-- payment section -->
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 p-3 " style="background;">
                    <div class="col-12 p-3 mb-3 shadow rounded bg-light">
                        <!-- header -->
                        <div class="col-12 p-3 mb-3 d-none">
                            <h5 class="text-uppercase">Available Payment Methods</h5>
                            <button class="btn btn-info rounded-0 text-uppercase">Bank Slip</button>
                            <button class="btn btn-primary rounded-0 text-uppercase">Visa card</button>
                            <button class="btn btn-warning rounded-0 text-uppercase text-white">eWallie</button>
                        </div>
                        <!-- Bank Slip -->
                        <div class="col-12 p-3 mb-3">
                            <form>
                                <h5 class="text-uppercase">Bank Slip transaction method</h5>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="col-12 p-0">
                                        <label class="text-capitalize">school name:</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Effort baptist">
                                    <div class="col-12 p-0 d-flex justify-content-end">
                                        <i class="text-danger">* Required</i>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="col-12 p-0">
                                        <label class="text-capitalize">student name:</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Mr. John Doe">
                                    <div class="col-12 p-0 d-flex justify-content-end">
                                        <i class="text-danger">* Required</i>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="col-12 p-0">
                                        <label class="text-capitalize">deposite site:</label>
                                    </div>
                                    <select class="custom-select" id="inputGroupSelect02">
                                        <option selected>Choose Bank</option>
                                        <option value="1">ECOBANK</option>
                                        <option value="2">GTBANK</option>
                                        <option value="3">UBA</option>
                                    </select>
                                    <div class="col-12 p-0 d-flex justify-content-end">
                                        <i class="text-danger">* Required</i>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <div class="col-12 p-0">
                                        <label class="text-capitalize">Deposit slip number:</label>
                                    </div>
                                    <input type="text" class="form-control" placeholder="000-000-000">
                                    <div class="col-12 p-0 d-flex justify-content-end">
                                        <i class="text-danger">* Required</i>
                                    </div>
                                </div>
                                <!--  -->
                                <div class="input-group mb-3">
                                    <button type="button" class="btn btn-info rounded-0">MAKE PAYMENT <i class="fal fa-long-arrow-alt-right"></i> </button>
                                </div>
                            </form>
                        </div>
                        <!-- Visa card -->
                        <div class="col-12 p-3 mb-3 d-none">
                        </div>
                        <!-- eWallie -->
                        <div class="col-12 p-3 mb-3 d-none">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
    studentPromotion: `
        <!--  -->
        <div class="col-12 border-bottom mb-3">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 d-flex justify-content-center">
                    <img src="../assets/media/img/avatar/images.jpg" class="img-thumbnail img-thumbnail-height1">
                </div>
                <div class="col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9">
                    <p>John Doe</p>
                    <p> <b>Grade 10</b> </p>
                </div>
            </div>
        </div>
        <!--  -->
        <div class="col-12">
            <!--  -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <tr>
                        <td class="bg-danger text-white"><b>Subjects</b></td>
                        <td colspan="4" class="text-center"><b>Semester/Phases</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center font-weight-bold">1<sup>st</sup> period </td>
                        <td class="text-center font-weight-bold">2<sup>nd</sup> period </td>
                        <td class="text-center font-weight-bold">3<sup>rd</sup> period </td>
                        <td class="text-center font-weight-bold">4<sup>th</sup> period </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                </table>
            </div>
            <!--  -->
            <div class="table-responsive mb-4">
                <table class="table table-bordered">
                    <tr>
                        <td class="bg-danger text-white"><b>Subjects</b></td>
                        <td colspan="4" class="text-center"><b>Semester/Phases</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center font-weight-bold">1<sup>st</sup> period </td>
                        <td class="text-center font-weight-bold">2<sup>nd</sup> period </td>
                        <td class="text-center font-weight-bold">3<sup>rd</sup> period </td>
                        <td class="text-center font-weight-bold">4<sup>th</sup> period </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                        <td class="text-center">  </td>
                    </tr>
                </table>
            </div>

        </div>
    `,
    generic: {
        modal: function(title, content, size='md', conditions=0 ) {
            $("#generic-modal").remove();
            $("body").prepend( `
                <div class="modal fade" id="generic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-${size}" role="document">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <span id="generic-modal-title"></span>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="generic-modal-content">
                                <p>Body</p>
                            </div>
                        </div>
                    </div>
                </div>
            `);
            $("#generic-modal-title").html(title);
            // do not display header
            if (conditions.headerless == true) {
                $(".modal-header").remove();
            }
            // append content directly to containing div
            if (conditions.borderless == true) {
                $(".modal-content").html(content);
            } else {
                $("#generic-modal-content").html(content);
            }
            // automatically display modal
            if (conditions.auto == true) {
                $("body").append("<div id='programatic-modal-btn' data-toggle='modal' data-target='#generic-modal'>");
                $("#programatic-modal-btn").click();
            } 
        }, 
        closeModal: function() {
            $(".close").click();
        },
        prompt: function(options) {
            
            // add activation button
            $("body").append( $("<div id='programatic-prompt-btn' data-toggle='modal' data-target='#promptModal'>") );
            // 
            let icon = (options.icon == undefined) ? `<i class="fas fa-exclamation-triangle fa-3x text-warning text-center"></i>`: 
            `<i class="fas fa-check-circle fa-3x text-success text-center"></i>`;

            // add prompt
            $("body").prepend(`
                <div class="modal fade" id="promptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header border-0">
                            <button type="button"  data-dismiss="modal" aria-label="Close" class="close dismiss-prompt">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-4  d-flex justify-content-center" id="prompt-icon">
                                        ${icon}
                                    </div>
                                    <div class="col-8 font-weight-bold" id="prompt-notice">
                                        <p>${options.notice}</p>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-8" id="prompt-notice-detail">
                                        <p>${options.details}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button"  data-dismiss="modal" aria-label="Close" class="btn btn-secondary btn-sm rounded-0 dismiss-prompt prompt-controls">Cancel</button>
                                <button type="button" class="btn btn-danger btn-sm rounded-0 prompt-controls" id="prompt-proceed">Proceed</button>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                </div>
            `);
            
            // 
            if ( options.controls == false ) {
                $("#prompt-proceed").addClass('d-none');
            } 

            // click button to call prompt
            $("#programatic-prompt-btn").click();

            // 
            $(".dismiss-prompt").click(function() {
                $("#programatic-prompt-btn #promptModal").remove();
            });
            $("#prompt-proceed").click(function() {
                $(".dismiss-prompt").click();
                options.callback(true);
            });
        }, 
        pwdRest: function() {
            let form = `
                <form class=" form-sm shadow" id="password-reset-form" autocomplete="off">
                    <!-- image banner -->
                    <div class="login-form-banner rounded" style="background-image: url(../assets/media/img/educator.jpg); height: 130px;">
                        <div class="login-form-banner-overlay d-flex justify-content-center align-items-center rounded">
                            <h1 class="d-xl-block d-lg-block d-md-none d-sm-none d-none">Change Password</h1>
                            <h4 class="d-xl-none d-lg-none d-md-block d-sm-block d-block">Change Password</h4>
                        </div>
                    </div>
                    <div class="mt-4 col-12">
                        <div class="col-12 mb-3">
                            <!-- <label for="">Current Password:</label> -->
                            <div class="col-12 mb-4">
                                <!-- <label for="">Current Password</label> -->
                                <input type="text" id="currentPwd" required class="form-control sleak-input rounded-0 pl-0" placeholder="Current Password">
                                <i class='text-danger'> * Required</i>
                            </div>
                            
                        </div>
                        <div class="col-12 mb-3">
                            <!-- <label for="">New Password:</label> -->
                            <div class="col-12 mb-4">
                                <!-- <label for="">New Password</label> -->
                                <input type="text" id="newPwd" required class="form-control sleak-input rounded-0 pl-0" placeholder="New Password">
                                <i class='text-danger'> * Required</i>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <!-- <label for="">Confrim Password:</label> -->
                            <div class="col-12 mb-4">
                                <!-- <label for="">Confirm New Password</label> -->
                                <input type="text" id="confirmNewPwd" required class="form-control sleak-input rounded-0 pl-0" placeholder="Confirm New Password">
                                <i class='text-danger'> * Required</i>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="form-control btn btn-sm btn-outline-secondary rounded-0"  data-dismiss="modal" aria-label="Close">Cancel</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="form-control btn btn-sm btn-dark rounded-0">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            `;
            components.generic.modal('', form, '', { auto: true, borderless: true, headerless: true } );
        },
        onlineStatus: function(options) {
            if (options.type == 'online') {
                setTimeout(() => {
                    $(".onlineStatusMsg").remove();
                }, 1000);
            } else {
                $(".onlineStatus").html(`
                    <div class="alert-dark p-2 animated fadeIn fast onlineStatusMsg"><b>Notice:</b> No internet connection</div>
                `);
            }
        },
        message: function(type, body, destination=0, timeout=0, css) {
            let target = (destination == '') ? $(".workspace-dynamic-area"): $(destination);
            target.html(`<div class="notice-box" style="${css}"></div>`);
            $(".notice-box").html(`
                <div class="${type} p-2 animated fadeIn slow app-message"><b>Notice:</b> ${body}</div>
            `);

            if (timeout == 'infinite') {
            } else {
                setTimeout(() => {
                    $(".app-message").removeClass("fadeIn").addClass("fadeOut");
                    setTimeout(() => {
                        $(".app-message").remove();
                    }, 300);
                }, (timeout == 0) ? 5000 : timeout);
            }
        },
        fullPageLoader: function(action) {
            if (action == 'show') {
                $("body").prepend(`
                    <div class="fullPageLoader animated">
                        <div class="text-center fullPageLoader-centered-section">
                            <i class="fad fa-spinner-third fa-spin fa-3x text-primary"></i>
                            <p><b>Loading Contents...</b></p>
                        </div>
                    </div>
                `);
            } else if (action == 'hide') {
                $(".fullPageLoader").addClass("fadeOut");
                setTimeout(() => {
                    $(".fullPageLoader").remove();
                }, 500);
            }
            else if (typeof action == 'object') {
            
                let color = (action.icon == "danger") ? 'danger': 'warning';

                $(".fullPageLoader-centered-section").html(`
                    <i class="fad fa-exclamation-triangle fa-3x animated bounce text-${color}"></i><br>
                    ${action.description}
                `);
            }
            
        },
        staffTile: function(destination, photo, name, position, duties) {
            $(destination).append(`
                <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
                    <div class="card border-0 ">
                        <div class="card-body info-modal-staff-card" style="background-image: url(${photo});">
                        </div>
                        <div class="card-footer">
                            <h6 class="text-center mt-1"><b>${name}</b></h6>
                            <h6 class="text-center mt-1"><i>${position}</i></h6>
                            <h6 class="text-center mt-1">${duties}</h6>
                        </div>
                    </div>
                </div>
            `);
        },
        bulletinCards: function (destination, file, title, postedOn, postedBy, details) {
            let filePathInfo = file.split(".");
            filePathInfo = filePathInfo[filePathInfo.length-1];
            if ( 
                filePathInfo == "png"  || 
                filePathInfo == "jpg"  || 
                filePathInfo == "jpeg" ||  
                filePathInfo == "gif"
            ) {
                file =  `<a href="${file}" target="_blank"> <img src="${file}" style="width:100%; height:;"></a>`;
            } 
            else if (filePathInfo == '') {
                file = '';
            }
            else {
                file =  `<a href="${file}" download> <i class="fad fa-file-alt fa-2x"></i> </a>`;
            }
            $(destination).append(`
                <div class="col-11 mb-3 border rounded bulletinCard bg-light">
                    <div class="row d-flex ">
                        <div class="col-3 p-0  bg-light d-flex justify-content-center">
                            ${file}
                        </div>
                        <div class="col-9 bg-white bulletinCard-detail-wrapper" style="height:200px; overflow:hidden; position:relative; transition:500ms;">
                            <b>${title}</b><br>
                            <i style="font-size:11px;">${postedOn}</i><br>
                            <i style="font-size:11px;">- ${postedBy}</i><br><br>
                            <div class="col p-0 bulletinCard-detail-section mb-5" style="height:50%; word-wrap: break-word; overflow:hidden; ">
                                ${details}
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-8 col-8 text-center rounded alert-primary border" style="position: absolute; right: 2%; bottom:2%; ">
                                <i class="bulletinCard-height-toggler pointer">Read More</i>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        },
        BulletinEditableCard: function(options) {
            let file = options.file;
            let filePathInfo = file.split(".");

            filePathInfo = filePathInfo[filePathInfo.length-1];
            if ( 
                filePathInfo == "png"  || 
                filePathInfo == "jpg"  || 
                filePathInfo == "jpeg" ||  
                filePathInfo == "gif"
            ) {
                file =  `<a href="${file}" target="_blank"> <img src="${file}" class="img-thumbnail" style="width:100%; height:200px;"></a>`;
            } 
            else if (filePathInfo == '') {
                file = '';
            }
            else {
                file =  `<a href="${file}" download> <i class="fad fa-file-alt fa-2x"></i> </a>`;
            }

            $(options.destination).append(`
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 dynamic-cards BulletinEditableCard">
                    <form class="card border-0  shadow admin-editable-bulletin " record-id="${options.id}">
                        <div class="card-header bg-white border-0 text-uppercase">
                            <div class="row">
                            <div class="col-xl-10 col-lg-10 col-md-10 col-sm-10 col-10">
                                <b class="admin-editable-bulletin-title">${options.title}</b>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                <i class="fad fa-pencil pointer admin-editable-btn"></i>
                            </div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <div class="col-12  bg-light d-flex justify-content-center file-previewer">
                                ${file}
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="file" class="form-control hidden file-selector">
                        </div>
                        <div class="card-body admin-editable-bulletin-message">
                            <p>- ${options.date_and_sharer}</i></p>
                            <div class="col-12 p-0 mb-3 admin-bulletin-audiance">
                                <p><b>Audiance:</b>  <span>${options.audiance}</span> </i></p>
                            </div>
                            <div class="admin-bulletin-content">
                                <p>${options.description}</p>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 text-uppercase admin-bulletin-control-btns"></div>
                    </form>
                </div>            
            `);
        },
        BulletinNewCard: function(options=0) {
            $("#bulletin-addNew-tile").after(`
                <form class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 dynamic-cards animated fadeInUp faster" id="AdminBulletinNewCard">
                    <div class="card border-0  shadow admin-editable-bulletin ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <b class="admin-editable-bulletin-title">Add new item to bulletin</b>
                                </div>
                                <div class="col-2 mb-3">
                                    <i class="fad fa-times pointer float-right" id="dismiss-new-bulletin-tile"></i>
                                </div>
                                <div class="col-12 mb-3">
                                    <input type="text" id="AdminBulletinNewCard-title" required placeholder="News Title" class="form-control">
                                </div>
                                <div class="col-6 mb-3">
                                    <select class="custom-select form-control" required id="AdminBulletinNewCard-audiance">
                                        <option value="" disabled selected>Audiance</option>
                                        <option value="public">public</option>
                                        <option value="admin">admin</option>
                                        <option value="teacher">teacher</option>
                                        <option value="student">student</option>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="pointer">
                                        <input type="file" class="form-control file" id="AdminBulletinNewCard-file">
                                    </label>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control" required rows="3" id="AdminBulletinNewCard-details" placeholder="Type news body here..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 text-uppercase admin-bulletin-control-btns">
                            <button class="btn btn-sm btn-primary  shadow float-right" id="AdminBulletinNewCard-save"> <i class="fad fa-save"></i> Save</button>
                        </div>
                    </div>
                </form>
            `);
        },
        questionBlock: function(options) {
            $(options.target).append(`
                <!-- quiz builder question block  -->
                <div class="card shadow-1 border-0 mb-5 animated fadeInUp quiz_builder_question_block">
                    <div class="card-body p-3" style="border-left: 4px solid blue;">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <!-- question field -->
                                <textarea class="form-control sleak-input mb-3 rounded-0" required placeholder="Add Question Here" id=""rows="1" style="font-size: 20px;"></textarea>
                                <!-- options fields -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0  bg-white " id="Option1_">
                                        <i class="fas fa-times text-danger"></i> &nbsp; Option 1
                                        </span>
                                    </div>
                                    <input type="text" class="form-control sleak-input" required id="Option1_${options.index}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <!-- options fields -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0  bg-white " id="Option2_">
                                        <i class="fas fa-times text-danger"></i> &nbsp; Option 2
                                        </span>
                                    </div>
                                    <input type="text" class="form-control sleak-input" required id="Option2_${options.index}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <!-- options fields -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0  bg-white " id="Option3_">
                                        <i class="fas fa-times text-danger"></i> &nbsp; Option 3
                                        </span>
                                    </div>
                                    <input type="text" class="form-control sleak-input" required id="Option3_${options.index}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                                <!-- options fields -->
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text border-0  bg-white " id="Answer_">
                                        <i class="fas fa-check text-success"></i> &nbsp; Answer
                                        </span>
                                    </div>
                                    <input type="text" class="form-control sleak-input" required id="Answer_${options.index}" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <!-- <div class="col-3 mb-3"></div> -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-6">
                                <div class="input-group mb-3">
                                    <select class="custom-select " id="point1_${options.index}">
                                    <option selected disabled>Points</option>
                                    <option value="1">1 point</option>
                                    <option value="2">2 points</option>
                                    <option value="3">3 points</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6 col-6 text-right">
                                <i class="fad fa-trash-alt pointer delete-question-block"></i>
                            </div>
                        </div>
                        
                    </div>
                </div>
            `);
        },
        tabsContentViewer: function() {
            // options = {destination:'', buttons: '', }
            $('body').html(`
                <div class="col rounded mt-5 mb-4">
                    <div class="col-12 p-0 horizontal-scroll- atlas-tab-btn-wrapper">
                        <span class=" atlas-tab-btn atlas-tab-btn-active  bg-white  toggable shadow-1 toggable-tab-active" data-target="item-1">Registration Plan</span>
                        <span class=" atlas-tab-btn bg-white   toggable shadow-1 toggable-tab-active" data-target="item-2">Tuition Plan</span>
                    </div>
                    <div class="col-12 shadow-1 bg-white atlas-tab-content-viewer">
                        <!-- view 1 -->
                        <div class=" animated fadeIn slow toggable-view" id="item-1">
                            <h2>item-1</h2>
                        </div>
                        <!-- view 2 -->
                        <div class=" animated d-none fadeIn slow toggable-view" id="item-2">
                            <h2>item-2</h2>
                        </div>
                    </div>
                </div>
            `);
        },
        manualGradeInputField: function (options) {
            $(options.destination).html(`
                <!-- new manual grade -->
                <div class="grade-block-new mb-3 shadow animated fadeIn slow col-12">
                    <div class="col-12 mt-3 pt-3">
                        <h5>Enter Grade Manually</h5>
                    </div>
                    <div class="col-12  p-1 mb-3">
                        <select class="custom-select sleak-input" required id="">
                            <option value="" selected disabled>Select Activity</option>
                            <option value="Test">(Test)</option>
                            <option value="Classwork">Classwork</option>
                            <option value="Project">Project</option>
                            <option value="Homework">Homework</option>
                        </select>
                    </div>
                    <div class="col-12  p-1 mb-3">
                        <textarea class="form-control sleak-input" placeholder="Activity Description"></textarea>
                    </div>
                    <div class="col-12 p-1 ">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <input type="date" class="form-control sleak-input" placeholder="Submittion Date">
                            </div>
                            <div class="col-6 mb-3">
                                <input type="number" class="form-control sleak-input" placeholder="Score">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-1 ">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-left">
                                <button type="button" class="btn btn-sm btn-outline-primary mb-3 text-uppercase" id="remove-manual-grade-input"> 
                                    Cancel
                                </button>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary mb-3 text-uppercase"> 
                                    Save Grades
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        },
        employee_search_result: function(options) {
            $(options.destination).append(`
                <!-- employee search result  -->
                <div class="row  p-1 pointer employee_search_result" record-id="${options.id}">
                  <div class="col-3 col-sm-3 col-md-3 col-lg-2 col-xl-2 p-0">
                    <img src="${options.image}" alt="" class="img-thumbnail" style="width:60px; height: 60px; border-radius: 100%; display: block; margin: auto;">
                  </div>
                  <div class="col-9 col-sm-9 col-md-9 col-lg-10">
                    <h6 class="">${options.fullname}</h6>
                    <h6 style="font-size: 12px;">${options.position}</h6>
                  </div>
                </div>
            `);
        },
        assigned_classes_and_subjects_card: function(options) {
            // 
            let subjects = [];
            // 
            for (let index = 0; index < options.subject_list.length; index++) {
                // const element = options.subject_list[index];
                subjects.push(`
                    <span class="badge badge-pill badge-light shadow-1 p-2 mb-3">${options.subject_list[index]}</span>
                `);
            }
            $(options.destination).append(`
                <!-- question card -->
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mb-4 pl-0 assigned_classes_and_subjects_card">
                    <div class="col-12 border-0 shadow-1 p-0">
                        <!-- header -->
                        <div class="col-12 p-3 bg-light2 question-card-header3">
                            ${options.trade_area}
                        </div>
                        <!--  -->
                        <div class="col-12 mt-4" style="height: 100px; overflow: hidden; overflow: auto;">
                            <!-- tags -->
                            <div class="col-12 p-0" style="white-space: normal !important;">
                                ${subjects.join(' ')}
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0">
                            <a href="javascript:void(0)" 
                                class="unassign-tradeArea" 
                                data-trade-area-id="${options.id}" 
                                data-trade-area="${options.trade_area}">Unassign</a>
                        </div>
                    </div>
                </div> 
            `);
            // 
            subjects = []; // flush the array
        },
        staffBulletin: function(options) {
            $(options.destination).append(`
                <!--  -->
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4">
                    <div class="card border-0  shadow-1 ">
                        <div class="card-header border-0 text-uppercase">
                            <div class="row">
                                <div class="col-10">
                                    ${options.title}
                                </div>
                                <div class="col-2 d-flex justify-content-end">
                                    <i class="fad fa-thumbtack"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-body user-bulletin-content">
                            <p>${options.date}</p>
                            <p>${options.body}</p>
                        </div>
                        <div class="card-footer border-0 bg-white text-uppercase">
                            <span class="pointer toggle-none-admin-bulletin">read more <i class="fad fa-chevron-down"></i> </span>
                        </div>
                    </div>
                </div>
            `);
        },
        studentTbl: function(options) {
            $(options.destination).append(`
                <!-- custom table row -->
                <div class="custom-table-data-section shadow-1-md">
                    <div class="custom-table-data-section-row borderless-row">
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">
                            <img src="${options.image}" class="img-thumbnail-height1" alt="">
                        </div>

                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">id</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">${options.id}</div>


                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Name</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">${options.fullname}</div>


                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Action</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data align-items-start">
                            <button class="btn btn-primary btn-sm shadow-1 show-students-details" atlas-id="${options.id}" style="border-radius: 25px;"> 
                                DETAILS <span class="show-student-details-spinner"> <i class="fad fa-long-arrow-alt-right"></i> </span> 
                            </button>
                        </div>
                    </div>
                </div>            
            `);
        },
        applicantTbl: function(options) {
            $(options.destination).append(`
                <!-- custom table row -->
                <div class="custom-table-data-section shadow-1-md">
                    <div class="custom-table-data-section-row borderless-row">
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">
                            <img src="${options.image}" class="img-thumbnail-height1" alt="">
                        </div>

                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Name</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">${options.fullname}</div>

                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Gender</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">${options.gender}</div>

                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Contact</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data"> <a href="tel:${options.contact}">${options.contact}</a></div>

                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Class</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data">${options.trade_areas}</div>

                        <!-- header sm and mini only -->
                        <div class="custom-table-data-section-sm-header">Action</div>
                        <!-- body -->
                        <div class="custom-table-data-section-sm-data align-items-start">
                            <button class="btn btn-primary btn-sm shadow-1 show-applicant-details" data-atlas-id="${options.id}" style="border-radius: 25px;"> DETAILS  <span class="show-applicant-details-spinner"> <i class="fad fa-long-arrow-alt-right"></i> </span>  </button>
                        </div>
                    </div>
                </div>
            `);
        },
        applicantDetailFormFields: function(options) {
            $(options.destination).html(`
                <!--  -->
                <div class="col-12 rounded bg-white p-3 shadow-1 d-flex justify-content-center applicant-detail-form-fields-self" style="position: relative;">
                    <div class="col-12">
                        <!-- close applicant detail view -->
                        <i class="fad fa-times fa-2x text-dark pointer applicant-detail-view" style="position: absolute; right: 0;"></i>
                        <!--  -->
                        <img src="${options.photo}" alt="" class="img-thumbnail img-thumbnail-height2" style="margin: auto; display: block;">
                        <!--  -->
                        <div class="col-12 mt-3 p-0">
                            <div class="row">
                                <!-- Fullname -->
                                <div class="col-12 p-1">
                                	<label class="col-12 text-center"><b>Fullname</b></label>
                                    <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.Fullname}">
                                </div>
                                <!-- Mobile -->
                                <div class="col-12 p-1">
                                	<label class="col-12 text-center"><b>Mobile</b></label>
                                    <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.Mobile}">
                                </div>
                                <!-- emial -->
                                <div class="col-6 p-1">
                                	<label class="col-12 text-center"><b>Email</b></label>
                                    <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.emial}">
                                </div>
                                <!-- gender -->
                                <div class="col-6 p-1">
                                	<label class="col-12 text-center"><b>Gender</b></label>
                                    <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.gender}">
                                </div>
                                <!-- Date of birth -->
                                <div class="col-12 p-1">
                                	<label class="col-12 text-center"><b>Date of birth</b></label>
                                    <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.DOB}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="col-12 mt-3 mb-3 rounded bg-white shadow-1 d-flex justify-content-center">
                    <div class="col-12 mt-3 ">
                        <div class="row">
                            <!-- Place of birth -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Place of birth</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.place_of_birth}">
                            </div>
                            <!-- nationality -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Nationality</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.nationality}">
                            </div>
                            <!-- address -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Address</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.address}">
                            </div>
                            <!-- Scholarship status -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Scholarship?</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.tuition_status}">
                            </div>
                        </div>
                    </div>
                </div> 
                <!--  -->
                <div class="col-12 mt-3 mb-3 rounded bg-white shadow-1 d-flex justify-content-center">
                    <div class="col-12 mt-3 ">
                        <div class="row">
                            <!-- Name of scholarship provider -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Name of scholarship provider</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.t_s_institution_or_sponsor_name}">
                            </div>
                            <!-- Scholarship provider phone -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Scholarship provider phone</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.t_s_phone}">
                            </div>
                            <!-- Scholarship provider email -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Scholarship provider email</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.t_s_email}">
                            </div>
                            <!-- Academic status -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Academic status</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.academic_status}">
                            </div>
                        </div>
                    </div>
                </div>  
                <!--  -->
                <div class="col-12 mt-3 mb-3 rounded bg-white shadow-1 d-flex justify-content-center">
                    <div class="col-12 mt-3 ">
                        <div class="row">
                            <!-- First time attending vocational school -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>First time attending vocational school</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.first_time_attending_vocational_school}">
                            </div>
                            <!-- Name of school have attended -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Name of school have attended</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.name_of_school_have_attended}">
                            </div>
                            <!-- Location of school have attended -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Location of school have attended</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.location_of_school_have_attended}">
                            </div>
                        </div>
                    </div>
                </div>    
                <!--  -->
                <div class="col-12 mt-3 mb-3 rounded bg-white shadow-1 d-flex justify-content-center">
                    <div class="col-12 mt-3 ">
                        <div class="row">
                            <!-- Emergency contact first name  -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Emergency contact first name</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.emc_first_name}">
                            </div>
                            <!-- Emergency contact last name  -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Emergency contact last name</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.emc_last_name}">
                            </div>
                            <!-- Emergency contact gender  -->
                            <div class="col-6 p-1">
                            	<label class="col-12 text-center"><b>Emergency contact gender</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.emc_gender}">
                            </div>
                            <!-- Emergency contact address  -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Emergency contact address</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.emc_address}">
                            </div>
                            <!-- Emergency contact phone -->
                            <div class="col-12 p-1">
                            	<label class="col-12 text-center"><b>Emergency contact phone</b></label>
                                <input type="text" class="form-control rounded-0 text-center mb-2 bg-white border-0 text-uppercase" disabled value="${options.emc_phone}">
                            </div>
                        </div>
                    </div>
                </div>  
            `);
        },
        studentDetailFormFields: function(options) {
            $(options.destination).html(`
                <form id="enrollment-form" autocomplete="off" enctype="multipart/form-data" user-id="${options.id}">
                    <div class="row p-3 mt-4">
                        <!-- photo -->
                        <div class="container mb-3 d-flex justify-content-center">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 d-flex justify-content-center">
                                <label class="pointer">
                                    <div class="p-0  bg-light- d-flex justify-content-center align-items-center" id="photo-bg" original-file="url('${options.photo}')" style="width:150px; height: 150px;  background-image: url('${options.photo}'); background-size: cover;">
                                        <input type="file" id="photo" name="photo" class="hide-upload-btn">
                                    </div>
                                    <label class="col" id="">Change Image</label>
                                </label>
                            </div>
                        </div>
                        <!-- student-image-change-confirmation-section -->
                        <div class="container col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 mb-3">
                            <div id="student-image-change-confirmation-section" class="hidden">
                                <div class="row p-0">
                                    <div class="col-6 text-center">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-xs btn-primary form-control" id="save-student-new-image">Save</button>
                                        </div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-sm btn-danger form-control" id="remove-student-new-image">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Status -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                            <label>Status: </label>
                            
                            <div class="row p-3">
                                <!-- active -->
                                <div class="custom-control custom-switch col">
                                    <input type="radio" class="custom-control-input status-switcher" name="status" id="status_active"  ${( options.status == 'active' ) ? `checked`:`` } required value="active">
                                    <label class="custom-control-label" for="status_active">active</label>
                                </div>
                                <!-- pending registration -->
                                <div class="custom-control custom-switch col">
                                    <input type="radio" class="custom-control-input status-switcher" name="status" id="status_pending_registration" ${( options.status == 'pending registration' ) ? `checked`:`` } value="pending registration">
                                    <label class="custom-control-label" for="status_pending_registration">pending registration</label>
                                </div>
                                <!-- suspended -->
                                <div class="custom-control custom-switch col">
                                    <input type="radio" class="custom-control-input status-switcher" name="status" id="status_suspend" ${( options.status == 'suspended' ) ? `checked`:`` } value="suspended">
                                    <label class="custom-control-label" for="status_suspend">suspended</label>
                                </div>
                                <!-- terminated -->
                                <div class="custom-control custom-switch col">
                                    <input type="radio" class="custom-control-input status-switcher" name="status" id="status_terminate" ${( options.status == 'terminated' ) ? `checked`:`` } value="terminated">
                                    <label class="custom-control-label" for="status_terminate">terminated</label>
                                </div>
                            </div>
                        </div>


                        <!-- textual info -->
                        <!-- Fullname -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                            <label>First name: </label>
                            <input type="text" id="applicant_first_name" required class="form-control sleak-input rounded-0" value="${options.Fullname}">
                            <i class='text-danger'> * Required</i>
                        </div>
                        <!-- Date of Birth -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                            <label for="month"> Date of Birth:  </label>
                            <input type="date" required id="applicant_DOB" class="form-control sleak-input rounded-0" value="${options.DOB}">
                            <i class='text-danger'> * Required</i>
                        </div>
                        <!-- Place of Birth  -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                            <label>Place of Birth: </label>
                            <input type="text" id="applicant_Place_of_Birth" required class="form-control sleak-input rounded-0" value="${options.place_of_birth}">
                            <i class='text-danger'> * Required</i>
                        </div>
                        <!-- Nationality -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                            <label>Nationality: </label>
                            <input type="text" id="applicant_Nationalities" required class="form-control sleak-input rounded-0" value="${options.nationality}">
                            <i class='text-danger'> * Required</i>
                        </div>
                        <!-- Gender -->
                        <div class="col-12 mb-5">
                            <div class="col p-0">
                                <div class="row">
                                    <div class="col-4 ">
                                        <label>Gender: </label>
                                    </div>
                                    <div class="col-8 p-0">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <label>
                                                        <input class="form-check-input gender" type="radio" required name="applicant_gender" ${( options.gender == 'male' ) ? `checked`:`` } value="male">
                                                        Male
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-6 p-0">
                                                <div class="form-check">
                                                    <label>
                                                        <input class="form-check-input gender" type="radio" name="applicant_gender" ${( options.gender == 'Female' ) ? `checked`:`` }  value="Female">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class='text-danger'> * Required</i>
                        </div>
                        <!-- Phone -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                            <label>Phone: </label>
                            <input type="text" id="applicant_phone" required class="form-control sleak-input rounded-0" value="${options.Mobile}">
                            <i class='text-danger'>  * Required</i>
                        </div>
                        <!-- Email -->
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                            <label>Email: </label>
                            <input type="email" id="applicant_email" class="form-control sleak-input rounded-0" value="${options.emial}">
                            <i class='text-info'> * Optional</i>
                        </div>
                        <!-- Address -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                            <label>Address: </label>
                            <input type="text" id="applicant_Address" required class="form-control sleak-input rounded-0" value="${options.address}">
                            <i class='text-danger'> * Required</i>
                        </div>
                        <!-- Tuition Status -->
                        <div class="col-12 mb-5 skip-container">
                            <div class="col p-0">
                                <div class="row">
                                    <div class="col-6 ">
                                        <label> Tuition Status </label>
                                    </div>
                                    <div class="col-6 p-0">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <label>
                                                        <input class="form-check-input self-supported skip applicant_tuition_status" type="radio" name="applicant_tuition_status" data-skip="scholarship" value="yes" 
                                                        ${( options.tuition_status == 'yes' ) ? `checked`:`` } required>
                                                        Scholarship
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-6 p-0">
                                                <div class="form-check">
                                                    <label>
                                                        <input class="form-check-input self-supported skip applicant_tuition_status" type="radio" name="applicant_tuition_status" data-skip="none" value="no" 
                                                        ${( options.tuition_status == 'no' ) ? `checked`:`` }>
                                                        Self-Cash Payment
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="skip-section scholarship-skip-section hidden">

                                <div class="row p-4">
                                    <!-- Institution or indivual responsible for fee payment -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 pl-0">
                                        <label>Name of Institution or indivual responsible for fee payment: </label>
                                        <input type="text" id="scholarship_provider" class="form-control sleak-input rounded-0"
                                        value="${(options.t_s_institution_or_sponsor_name == '' || options.t_s_institution_or_sponsor_name == 'none') ? ``: options.t_s_institution_or_sponsor_name }">
                                        <i class='text-info'>  * Optional</i>
                                    </div>
                                    <!-- Phone -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5 pl-0">
                                        <label>Phone: </label>
                                        <input type="text" id="scholarship_provider_phone" class="form-control sleak-input rounded-0" 
                                        value="${(options.t_s_phone == '' || options.t_s_phone == 'none') ? ``: options.t_s_phone }">
                                        <i class='text-info'>  * Optional</i>
                                    </div>
                                    <!-- Email -->
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5 pl-0">
                                        <label>Email: </label>
                                        <input type="email" id="scholarship_provider_email" class="form-control sleak-input rounded-0" 
                                        value="${(options.t_s_email == '' || options.t_s_email == 'none') ? ``: options.t_s_email }">
                                        <i class='text-info'> * Optional</i>
                                    </div>
                                </div>        
                            </div>
                        </div>
                        <!-- Academic Status Checkbox -->
                        <div class="col-12 mb-5">
                            <div class="row">
                                <div class="col-12">
                                    <label>ACADEMY STATUS <span class="text-danger">(Please Check Category below)</span> </label>
                                </div>
                                <!-- College Graduate -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-3 col-12 p-4">
                                    <label>
                                        <input type="radio" value="College Graduate" name="academic_status" required class="form-check-input" value="College Graduate" 
                                        ${( options.academic_status == 'College Graduate' ) ? `checked`:`` }>
                                        College Graduate
                                    </label>
                                </div>
                                <!-- College Student -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-3 col-12 p-4">
                                    <label>
                                        <input type="radio" value="College Student" name="academic_status" class="form-check-input" value="College Student" 
                                        ${( options.academic_status == 'College Student' ) ? `checked`:`` }>
                                        College Student
                                    </label>
                                </div>
                                <!-- High School Graduate -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-3 col-12 p-4">
                                    <label >
                                        <input type="radio" value="High School Graduate" name="academic_status" class="form-check-input" value="High School Graduate" 
                                        ${( options.academic_status == 'High School Graduate' ) ? `checked`:`` }>
                                        High School Graduate
                                    </label>
                                </div>
                                <!-- High School Student -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-3 col-12 p-4">
                                    <label>
                                        <input type="radio" value="High School Student" name="academic_status" class="form-check-input" value="High School Student" 
                                        ${( options.academic_status == 'High School Student' ) ? `checked`:`` }>
                                        High School Student
                                    </label>
                                </div>
                                <!-- Below High School -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-3 col-12 p-4">
                                    <label>
                                        <input type="radio" value="Below High School" name="academic_status" class="form-check-input" value="Below High School" 
                                        ${( options.academic_status == 'Below High School' ) ? `checked`:`` }>
                                        Below High School
                                    </label>
                                </div>
                                <!-- None -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-3 col-12 p-4">
                                    <label>
                                        <input type="radio" value="None" name="academic_status" class="form-check-input" value="None" 
                                        ${( options.academic_status == 'None' ) ? `checked`:`` }>
                                        None
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Emergency Contact (not Completed) -->
                        <div class="col-12 mb-5">
                            <div class="row">
                                <div class="col-12 mb-3 text-uppercase">
                                    <label>Contact person in case of emergency</label>
                                </div>
                                <!-- First name -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label>First name: </label>
                                    <input type="text" id="Emergency_Contact_first_name" required class="form-control sleak-input rounded-0" value="${options.emc_first_name}">
                                    <i class='text-danger'> * Required</i>
                                </div>
                                <!-- Last name -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label>Last name: </label>
                                    <input type="text" id="Emergency_Contact_last_name" required class="form-control sleak-input rounded-0" value="${options.emc_last_name}">
                                    <i class='text-danger'> * Required</i>
                                </div>
                                <!-- Gender -->
                                <div class="col-12 mb-5">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4 ">
                                                <label>Gender: </label>
                                            </div>
                                            <div class="col-8 p-0">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-check">
                                                            <label>
                                                                <input class="form-check-input gender" type="radio" name="Emergency_Contact_gender" value="male" 
                                                                ${( options.emc_gender == 'male' ) ? `checked`:`` } required>
                                                                Male
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 p-0">
                                                        <div class="form-check">
                                                            <label>
                                                                <input class="form-check-input gender" type="radio" name="Emergency_Contact_gender" value="Female" 
                                                                ${( options.emc_gender == 'Female' ) ? `checked`:`` }>
                                                                Female
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <i class='text-danger'> * Required</i>
                                </div>
                                <!-- Address -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label>Address: </label>
                                    <input type="text" id="Emergency_Contact_Address" required class="form-control sleak-input rounded-0" value="${options.emc_address}">
                                    <i class='text-danger'> * Required</i>
                                </div>
                                <!-- Phone -->
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-5">
                                    <label>Phone: </label>
                                    <input type="text" id="Emergency_Contact_Phone" required class="form-control sleak-input rounded-0" value="${options.emc_phone}">
                                    <i class='text-danger'> * Required</i>
                                </div>
                            </div>
                        </div>
                        <!-- First time in a Vocational Training School -->
                        <div class="col-12 mb-5 skip-container">
                            <div class="col p-0">
                                <div class="row">
                                    <div class="col-6 ">
                                        <label>Have you Attended a Vocational Training School before? </label>
                                    </div>
                                    <div class="col-6 p-0">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check">
                                                    <label>
                                                        <input class="form-check-input self-supported skip previousVocationSchool" type="radio" name="previousVocationSchool" data-skip="previousVocationSchool" value="yes" ${( options.first_time_attending_vocational_school == 'yes' ) ? `checked`:`` }>
                                                        Yes
                                                    </label>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-6 p-0">
                                                <div class="form-check">
                                                    <label>
                                                        <input class="form-check-input self-supported skip previousVocationSchool" type="radio" name="previousVocationSchool" data-skip="none" value="no" 
                                                         ${( options.first_time_attending_vocational_school == 'no' ) ? `checked`:`` }>
                                                        No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="skip-section previous_vocational_training_school hidden">
                            
                                <div class="row p-4">
                                    <!-- Institution or indivual responsible for fee payment -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 pl-0">
                                        <label>Name of school: </label>
                                        <input type="text" id="previous_vocation_school_name"  class="form-control sleak-input rounded-0" 
                                        value="${(options.name_of_school_have_attended == '' || options.name_of_school_have_attended == 'none') ? ``: options.name_of_school_have_attended }">
                                        <i class='text-info'>  * Optional</i>
                                    </div>
                                    <!-- Phone -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5 pl-0">
                                        <label>Location of school: </label>
                                        <input type="text" id="previous_vocation_school_Location"  class="form-control sleak-input rounded-0" 
                                        value="${(options.location_of_school_have_attended == '' || options.location_of_school_have_attended == 'none') ? ``: options.location_of_school_have_attended }">
                                        <i class='text-info'>  * Optional</i>
                                    </div>
                                </div>                            
                            
                            </div>
                            <!-- <i class='text-danger'> * Required</i> -->
                        </div>
                        <!-- Courses selection Checkbox -->
                        <div class="col-12 mb-5">
                            <div class="row p-2">
                                <div class="col-12">
                                    <label>Please Check Category of training desired: </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label>
                                        <input type="checkbox" value="Auto CAD" name="Courses_selection_Auto_CAD" id="Auto_CAD" class="form-check-input"  
                                        ${( options.Auto_CAD != 'no' ) ? `checked`:`` }>
                                        Auto CAD
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label>
                                        <input type="checkbox" value="Architectural Drafting" name="Courses_selection_Architectural_Drafting" id="" class="form-check-input"  
                                        ${( options.Architectural_Drafting != 'no' ) ? `checked`:`` }>
                                        Architectural Drafting
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Auto Mechanic" name="Courses_selection_Auto_Mechanic" id="" class="form-check-input"  
                                        ${( options.Auto_Mechanic != 'no' ) ? `checked`:`` }>
                                        Auto Mechanic
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Building Construction" name="Courses_selection_Building_Construction" id="" class="form-check-input"  
                                        ${( options.Building_Construction != 'no' ) ? `checked`:`` }>
                                        Building Construction
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Blue Print Reading" name="Courses_selection_Blue_Print_Reading" id="" class="form-check-input"  
                                        ${( options.Blue_Print_Reading != 'no' ) ? `checked`:`` }>
                                        Blue Print Reading
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Beauty Therapy" name="Courses_selection_Beauty_Therapy" id="" class="form-check-input"  
                                        ${( options.Beauty_Therapy != 'no' ) ? `checked`:`` }>
                                        Beauty Therapy
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Carpentry" name="Courses_selection_Carpentry" id="" class="form-check-input"  
                                        ${( options.Carpentry != 'no' ) ? `checked`:`` }>
                                        Carpentry
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Computer Software" name="Courses_selection_Computer_Software" id="" class="form-check-input"  
                                        ${( options.Computer_Software != 'no' ) ? `checked`:`` }>
                                        Computer Software
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Computer Hardware" name="Courses_selection_Computer_Hardware" id="" class="form-check-input"  
                                        ${( options.Computer_Hardware != 'no' ) ? `checked`:`` }>
                                        Computer Hardware
                                    </label>
                                </div>
                                
                                <!-- My Start -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Computer Software Professional " name="Courses_selection_Computer_Software_Professional  " id="" class="form-check-input"  ${( options.Computer_Software_Professional != 'no' ) ? `checked`:`` }>
                                        Computer Software Professional 
                                    </label>
                                </div>

                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Catering" name="Courses_selection_Catering" id="" class="form-check-input"  
                                        ${( options.Catering != 'no' ) ? `checked`:`` }>
                                        Catering
                                    </label>
                                </div>

                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Electricity" name="Courses_selection_Electricity" id="" class="form-check-input"  
                                        ${( options.Electricity != 'no' ) ? `checked`:`` }>
                                        Electricity
                                    </label>
                                </div>

                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Event Management" name="Courses_selection_Event_Management" id="" class="form-check-input"  
                                        ${( options.Event_Management != 'no' ) ? `checked`:`` }>
                                        Event Management
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Electronic" name="Courses_selection_Electronic" id="" class="form-check-input"  
                                        ${( options.Electronic != 'no' ) ? `checked`:`` }>
                                        Electronic
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Estimating" name="Courses_selection_Estimating" id="" class="form-check-input"  
                                        ${( options.Estimating != 'no' ) ? `checked`:`` }>
                                        Estimating
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Fashion Design" name="Courses_selection_Fashion_Design" id="" class="form-check-input"  
                                        ${( options.Fashion_Design != 'no' ) ? `checked`:`` }>
                                        Fashion Design
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Hotel Management" name="Courses_selection_Hotel_Management" id="" class="form-check-input"  
                                        ${( options.Hotel_Management != 'no' ) ? `checked`:`` }>
                                        Hotel Management
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Interior Decoration" name="Courses_selection_Interior_Decoration" id="" class="form-check-input"  
                                        ${( options.Interior_Decoration != 'no' ) ? `checked`:`` }>
                                        Interior Decoration
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Tailoring" name="Courses_selection_Tailoring" id="" class="form-check-input"  
                                        ${( options.Tailoring != 'no' ) ? `checked`:`` }>
                                        Tailoring
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Pastry" name="Courses_selection_Pastry" id="" class="form-check-input"  
                                        ${( options.Courses_selection_Pastry != 'no' ) ? `checked`:`` }>
                                        Pastry
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Plumbling" name="Courses_selection_Plumbling" id="" class="form-check-input"  
                                        ${( options.Plumbling != 'no' ) ? `checked`:`` }>
                                        Plumbling
                                    </label>
                                </div>
                                <!--  -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 mt-3">
                                    <label >
                                        <input type="checkbox" value="Project Managament" name="Courses_selection_Project_Managament" id="" class="form-check-input"  
                                        ${( options.Project_Managame != 'no' ) ? `checked`:`` }>
                                        Project Managament
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- controls -->
                        <div class="col-12 mb-2 p-0">
                            <div class="col-12">
                                <button class="btn btn-primary col-12 shadow-1">Save Changes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </form>
            `);
        },
        notes: {
            textLesson(options) {
                $(options.destination).html(`
                    <form class="col-12 p-0 bg-white  rounded p-3 animated fadeIn delay-2" id="regular-note-form">
                        <!-- title -->
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12  d-flex align-items-center">
                                    <h6><b>Title:</b></h6>
                                </div>
                                <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12 ">
                                    <input type="text" class="form-control" id="regular-note-title" required placeholder="Title of note">
                                    <i class="text-danger float-right">(Mandatory)</i>
                                </div>
                            </div>
                        </div>
                        <!-- content -->
                        <div class="col-12 mb-3" id="note-reading-viewer">
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12">
                                    <h6><b>Body:</b></h6>
                                </div>
                                <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12 ">
                                    <textarea class="form-control" id="regular-note-body" required cols="30" rows="6" placeholder="Lesson content/Description"></textarea>
                                    <i class="text-danger float-right">(Mandatory)</i>
                                </div>
                            </div>
                        </div>
                        <!-- file -->
                        <div class="col-12 mb-4" id="note-reading-viewer">
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12">
                                    <h6><b>PDF:</b></h6>
                                </div>
                                <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12 ">
                                    <input type="file" class="form-control" id="regular-note-pdf" accept=".pdf">
                                    <i class="text-info float-right">(Optional)</i>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12">
                                </div>
                                <div class="col-xl-11 col-lg-11 col-md-12 col-sm-12 col-12 ">
                                    <button class="btn btn-primary col-12 rounded"> SAVE NOTE </button>
                                </div>
                            </div>
                        </div>
                    </form>
                `);
            },
            mediaLesson(options) {
                $(options.destination).html(`
                    <form class="col-12 p-0 bg-white  rounded p-3 animated fadeIn delay-2" id="media-form">
                        <!-- title -->
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12  d-flex align-items-center">
                                    <h6><b>Title:</b></h6>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 ">
                                    <input type="text" class="form-control" id="media-title" required placeholder="Title of video/audio">
                                    <i class="text-danger float-right">(Mandatory)</i>
                                </div>
                            </div>
                        </div>
                        <!-- Thumbnail -->
                        <div class="col-12 mb-3" id="note-reading-viewer">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                                    <h6><b>Thumbnail:</b></h6>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 ">
                                    <input type="file" class="form-control" id="media-thumbnail" accept=".jpg,.jpeg,.gif,.png">
                                    <i class="text-info float-right">(Optional)</i>
                                </div>
                            </div>
                        </div>
                        <!-- media -->
                        <div class="col-12 mb-4" id="note-reading-viewer">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                                    <h6><b>Media:</b></h6>
                                </div>
                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 ">
                                    <input type="file" class="form-control" id="media-content" required accept=".mp4,.mp3,.aac,.webm,.wav">
                                    <i class="text-danger float-right">(Mandatory)</i>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <div class="col-12">
                            <div class="row">
                                <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                                </div>
                                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 ">
                                    <button class="btn btn-primary col-12 rounded"> SAVE MEDIA </button>
                                </div>
                            </div>
                        </div>
                    </form>
                `);
            }
        },
        functionalities: {
            bulletinCardsControl: function() {
                $(".bulletinCard-height-toggler").click(function() {
                    let targetContainer                =  $(this).parents('.bulletinCard').find(".bulletinCard-detail-wrapper");
                    let targetContainerContentSection  =  $(this).parents('.bulletinCard').find(".bulletinCard-detail-section");
                    let targetContainerHeight          =  $(this).parents('.bulletinCard').find(".bulletinCard-detail-wrapper").css('height');
                    // toggle
                    if (targetContainerHeight == '200px') {
                        targetContainer.css('height', targetContainerContentSection.prop('scrollHeight')+'px', 'padding-bottom');
                        targetContainerContentSection.css('height', '100%');
                        $(this).html('Read Less');
                    } else {
                        targetContainer.css('height', '200px');
                        targetContainerContentSection.css('height', '50%');
                        $(this).html('Read More');
                    }
                    
                });
            }
        }
    }
}