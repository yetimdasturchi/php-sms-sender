<form class="form-horizontal site-otp" autocomplete="off" method="post">

                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <label for="otp"><?php echo lang_item('confirmation_code');?></label>
                                                    <div class="input-group mb-3">

                                                        <input class="form-control otp-mask" type="text" id="otp" name="otp" max="6" placeholder="<?php echo lang_item('otp_format', [], false);?>">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn waves-effect waves-light btn-inverse otp-resend" title="<?php echo lang_item('resend_confirmation_code')?>"><i class="fa fa-repeat"></i></button>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit"><?php echo lang_item('confirm');?></button>
                                                </div>
                                            </div>

                                        </form>