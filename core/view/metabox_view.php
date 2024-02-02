<?php

defined('ABSPATH') || exit;
?>
<div class="container">
    <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row fs-service-list mt-3" id="fs-service-list-tab-1">
                <div class="col-12">
                    <label class="my-2" for="fnps_service_1_select"><?php _e(' service 1', $this->FNPS_domain); ?></label>
                    <select id="fnps_service_1_select" class="form-select fnps_service_1_select" aria-label="Select Service" name="fnps_service_1">
                        <?php foreach ($fs_services as $fs_service) : ?>
                            <option value="<?php echo $fs_service->term_id  ?>"><?php echo $fs_service->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnps_service_2_select"><?php _e(' service 2', $this->FNPS_domain); ?></label>
                    <select id="fnps_service_2_select" class="form-select fnps_service_2_select" aria-label="Select Service" name="fnps_service_2">
                        <?php foreach ($fs_services as $fs_service) : ?>
                            <option value="<?php echo  $fs_service->term_id ?>"><?php echo  $fs_service->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnps_service_3_select"><?php _e(' service 3', $this->FNPS_domain); ?></label>
                    <select id="fnps_service_3_select" class="form-select fnps_service_3_select" aria-label="Select Service" name="fnps_service_3">
                        <?php foreach ($fs_services as $fs_service) : ?>
                            <option value="<?php echo  $fs_service->term_id ?>"><?php echo  $fs_service->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnps_service_4_select"><?php _e(' service 4', $this->FNPS_domain); ?></label>
                    <select id="fnps_service_4_select" class="form-select fnps_service_4_select" aria-label="Select Service" name="fnps_service_4">
                        <?php foreach ($fs_services as $fs_service) : ?>
                            <option value="<?php echo  $fs_service->term_id ?>"><?php echo  $fs_service->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnps_service_5_select"><?php _e(' service 5', $this->FNPS_domain); ?></label>
                    <select id="fnps_service_5_select" class="form-select fnps_service_5_select" aria-label="Select Service" name="fnps_service_5">
                        <?php foreach ($fs_services as $fs_service) : ?>
                            <option value="<?php echo  $fs_service->term_id ?>"><?php echo  $fs_service->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnps_service_6_select"><?php _e(' service 6', $this->FNPS_domain); ?></label>
                    <select id="fnps_service_6_select" class="form-select fnps_service_6_select" aria-label="Select Service" name="fnps_service_6">
                        <?php foreach ($fs_services as $fs_service) : ?>
                            <option value="<?php echo  $fs_service->term_id ?>"><?php echo  $fs_service->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$nonce = "";
if (isset($_REQUEST['tag_ID']) && $_REQUEST['tag_ID']) {
    $nonce = $_REQUEST['tag_ID'] . get_current_user_id();
} else {
    $nonce = get_the_ID() . get_current_user_id();
}
wp_nonce_field($nonce, $this->FNPS_nonce, false)
?>