"use strict";

// Class Definition
var KTAddUser = function () {
    // Private Variables
    var _formEl;
    var _avatar;
    var id=1;


    var _initValidations = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/


        // Validation Rules For Step 1
        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            }
                        }
                    },
                    father_name: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            }
                        }
                    },
                    grandfather_name: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            }
                        }
                    },
                    family_name: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            }
                        }
                    },
                    personal_id: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                            stringLength: {
                                min:9,
                                max:9,
                                message: personal_id_validation
                            }
                        }
                    },
                    wife_name: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                        }
                    },
                    wife_personal_id: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                            stringLength: {
                                min:9,
                                max:9,
                                message: personal_id_validation
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));


            _validations.push(FormValidation.formValidation(
                _formEl,
                {
                    fields: {
                        // Step 2
                        governorate: {
                            validators: {
                                notEmpty: {
                                    message: required_validation
                                },
                            }
                        },
                        city: {
                            validators: {
                                notEmpty: {
                                    message: required_validation
                                }
                            }
                        },
                        neighborhood: {
                            validators: {
                                notEmpty: {
                                    message: required_validation
                                }
                            }
                        },
                        mobile: {
                            validators: {
                                notEmpty: {
                                    message: required_validation
                                },
                                digits: {
                                    message: digits_validation
                                },
                                stringLength: {
                                    min: 10,
                                    max: 10,
                                    message: mobile_number_validation
                                }
                            }
                        },
                        mobile_tow: {
                            validators: {
                                digits: {
                                    message: digits_validation
                                },
                                stringLength: {
                                    min: 10,
                                    max: 10,
                                    message: mobile_number_validation
                                }
                            }
                        },

                        job_status: {
                            validators: {
                                choice: {
                                    min: 1,
                                    message: choose_validation
                                }
                            }
                        },
                        job_class: {
                            validators: {
                                choice: {
                                    min: 1,
                                    message: choose_validation
                                }
                            }
                        },
                        benefit_from_agency_coupon: {
                            validators: {
                                choice: {
                                    min: 1,
                                    message: choose_validation
                                }
                            }
                        },
                        benefit_from_social_affairs: {
                            validators: {
                                choice: {
                                    min: 1,
                                    message: choose_validation
                                }
                            }
                        },

                        is_noor_employee: {
                            validators: {
                                choice: {
                                    min: 1,
                                    message: choose_validation
                                }
                            }
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap()
                    }
                }
            ));

        _validations.push(FormValidation.formValidation(
            _formEl,
            {
                fields: {

                    family_status: {
                        validators: {
                            choice: {
                                min: 1,
                                message: choose_validation
                            }
                        }
                    },
                    family_count: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },
                    family_male_count: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },
                    family_female_male_count: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },
                    family_count_less_than_18: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },

                    family_male_count_less_than_18: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },
                    family_female_count_less_than_18: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },

                    family_with_disabled: {
                        validators: {
                            choice: {
                                min: 1,
                                message: choose_validation
                            }
                        }
                    },

                    disabled_count: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },

                    disabled_less_than_18_count: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },

                    family_with_patients: {
                        validators: {
                            choice: {
                                min: 1,
                                message: choose_validation
                            }
                        }
                    },

                    patients_count: {
                        validators: {
                            notEmpty: {
                                message: required_validation
                            },
                            digits: {
                                message: digits_validation
                            },
                        }
                    },

                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));
    }

    var _initAvatar = function () {
        _avatar = new KTImageInput('kt_user_add_avatar');
    }

    return {
        // public functions
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard');
            _formEl = KTUtil.getById('kt_form');

            _initWizard();
            _initValidations();
            _initAvatar();
        }
    };
}();

jQuery(document).ready(function () {
    KTAddUser.init();
});
