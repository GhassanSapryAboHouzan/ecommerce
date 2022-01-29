// Class definition
var KTFormControls = function () {
	// Private functions
	var _initDemo1 = function () {
		FormValidation.formValidation(
			document.getElementById('form_sound_add'),
			{
				fields: {
                    sound_image: {
						validators: {
							notEmpty: {
								message: 'required'
							},
						}
					},

                    name_ar: {
                        validators: {
                            notEmpty: {
                                message: 'required'
                            },
                        }
                    },

                    name_en: {
                        validators: {
                            notEmpty: {
                                message: 'required'
                            },

                        }
                    },


                    date: {
                        validators: {
                            notEmpty: {
                                message: 'required'
                            },

                        }
                    },
                    length: {
                        validators: {
                            notEmpty: {
                                message: 'required'
                            },

                        }
                    },





                    mawhob_class: {
                        validators: {
                            notEmpty: {
                                message: 'required'
                            }
                        }
                    },




                    file: {
                        validators: {
                            notEmpty: {
                                message: 'required'
                            },

                        }
                    },


				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	}


	return {
		// public functions
		init: function() {
			_initDemo1();
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
