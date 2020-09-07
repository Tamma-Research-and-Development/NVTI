import { api_resquest_maker } from './../../util/ajaxHandler.js';
import { apiEndpoints } from './../../util/apiEndpoints.js';
import { fileEndPoints } from './../../util/fileEndPoints.js';
import { components } from './../../util/components.js';

export const financeManager = {
    initialize: function() {
        this.financePaymentPlan.main(this);
    },
    financePaymentPlan:    {
        main: (parent) => {
            parent.financePaymentPlan.togglePaymentPlan();
        }, 
        togglePaymentPlan: function ()  {
            // control the height of the content when toggle
            $(".reg-info-tab").click(function() {
            

                const toggleContent =$(this).parents('.fees-card').find(".reg-info-details");
        
        
                if (toggleContent.hasClass('d-none')) {

                    toggleContent.parents('.fees-card').css({
                        // position: 'relative', 'z-index': '5',
                        height: 'auto'
                    });
                    toggleContent.removeClass("d-none").hide(0).slideDown();
                    $(this).removeClass("fa-chevron-circle-down").addClass("fa-chevron-circle-up");
                    
                
                } else {
                    toggleContent.parents('.fees-card').css({position: 'static', 'z-index': 0 });
                    toggleContent.slideUp(function(){
                        $(this).addClass("d-none");
                    })
                    $(this).addClass("fa-chevron-circle-down").removeClass("fa-chevron-circle-up");
                };
        
                    
            
            });
        
            
            // show form to add items needed for registration of a class
            $(".add-details-form").click(function(){
                const newPackageForm           =  $(this).parents(".reg-info-details").find(".details-form");
                const existingPackageWrapper   =  newPackageForm.find(".detail-items-reg");
        
                if (newPackageForm.hasClass("d-none")) {
                    $(this).removeClass('fa-plus').addClass('fa-minus');
                    newPackageForm.removeClass("d-none").addClass('animated fadeIn slow');
                    $(".detail-items-reg").addClass("d-none");
                } else {
                    $(this).removeClass('fa-minus').addClass('fa-plus');
                    newPackageForm.addClass('d-none')
                    $(".detail-items-reg").removeClass("d-none");
                    
                }
            });
        
            //    edit btn for registration
            
            $(".registration-editable-btn").click(function(){
        
                const  editableItems    =    $(this).parents('.current-card');
                const  title            =    editableItems.find(".registration-editable-title");
                const  studentType      =    editableItems.find(".registration-editable-student-type");
                const  itemsDescription =    editableItems.find(".fees-para");
                const  itemsFees        =    editableItems.find(".registration-editable-charges");
        
                if (editableItems.find(".registration-title-field").length == 0) {
        
                    $(this).removeClass('fa-edit').addClass('fa-times');
        
                    title.after(`<input type="text" class=" col-10 form-control rounded-0 sleak-input registration-title-field" placeholder="item" > `);
                    studentType.after( `
                        <div class="row registration-student-type-field">
                            <input type="text" class= "col-6 sleak-input border-right" placeholder="New Student" >
                            <input type="text" class= "col-6 sleak-input" placeholder="Semester">
                        </div>
                    `);
        
                    title.hide();
                    studentType.hide();
                    itemsDescription.hide();
                    itemsFees.hide();
        
                    itemsDescription.after(`
                        <textarea class="form-control sleak-input rounded-0" rows="2" placeholder="description">${itemsDescription.html()}</textarea>
                    `);
        
                    itemsFees.after(`<input type="text" class=" form-control sleak-input rounded-0" value= "${itemsFees.html()}">
                        <div class="row p-2 registration-control-btn">
                            <div class="col-6 ">
                                <i class="fad fa-trash pointer registration-item-delete-btn"></i>
                            </div>
                            <div class="col-6  text-right">
                                <i class="fad fa-save pointer registration-item-save-btn"></i>
                            </div>
                        </div>  
                    
                    `);
                    
                } else {
                    $(this).removeClass('fa-times').addClass('fa-edit');
                    title.show();
                    studentType.show();
                    itemsDescription.show();
                    itemsFees.show();
                    editableItems.find('input, textarea, .registration-control-btn').remove();
        
                }
            });
        
            // edit btn for tuition
        
            $(".tuition-editable-btn").click(function(){
        
                const  editableTuition           =    $(this).parents('.current-card');
                const  tuitionTitle              =    editableTuition.find(".tuition-editable-title");
                const  tuitionStudentType        =    editableTuition.find(".tuition-editable-student-type");
                const  tuitionInstallmentPayment =    editableTuition.find(".tuition-installment-payment")
                const  tuitionTotalFees          =    editableTuition.find(".tuition-editable-total-fees");
                
        
                if (editableTuition.find(".tuition-title-field").length == 0) {
        
                    $(this).removeClass('fa-edit').addClass('fa-times');
        
                    tuitionTitle.after(`<input type="text" class=" col-10 form-control rounded-0 sleak-input tuition-title-field" placeholder="Grade 1" > `);
        
                    tuitionStudentType.after( `
                        <div class="row tuition-student-type-field">
                            <input type="text" class= "col-6 sleak-input border-right" placeholder="New Student" >
                            <input type="text" class= "col-6 sleak-input" placeholder="Semester">
        
                        </div>
                    `);
        
                    tuitionInstallmentPayment.after(`
                        <div class="row tuition-installment-payment-field">
                            <input type="text" class= "col-6 sleak-input border-right" placeholder="1st Installment" >
                            <input type="text" class= "col-6 sleak-input" placeholder="2nd Installment">
                            <input type="text" class= "col-6 sleak-input border-right" placeholder="3rd Installment" >
                            <input type="text" class= "col-6 sleak-input" placeholder="4th Installment">
        
                        </div>
                    
                    `)
                    tuitionFees.after(`
                        <input type="text" class=" form-control sleak-input rounded-0" value= "${tuitionTotalFees.html()}">
                        <div class="row p-2 tuition-control-btn">
                            <div class="col-6 ">
                                <i class="fad fa-trash pointer tuition-fees-delete-btn"></i>
                            </div>
                            <div class="col-6  text-right">
                                <i class="fad fa-save pointer tuition-fees-save-btn"></i>
                            </div>
                        </div>  
                    
                    `);
                    tuitionTitle.hide();
                    tuitionStudentType.hide();
                    tuitionInstallmentPayment.hide();
                    tuitionFees.hide();
                }
        
                else{
                    $(this).removeClass('fa-times').addClass('fa-edit');
                    tuitionTitle.show();
                    tuitionStudentType.show();
                    tuitionInstallmentPayment.show();
                    tuitionFees.show();
                    editableTuition.find('input, textarea, .tuition-control-btn').remove();
                }
                
            });
    
        }
    }



}