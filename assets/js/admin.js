jQuery(document).ready(function ($) {
  const prefix = "_FNPS_settings_";
  if (FNPS && FNPS?.fnps_service_1 !== undefined) {
    console.log("service is", FNPS?.fnps_service_1);
    $(".fnps_service_1_select").val(FNPS?.fnps_service_1);
    $(".fnps_service_2_select").val(FNPS?.fnps_service_2);
    $(".fnps_service_3_select").val(FNPS?.fnps_service_3);
    $(".fnps_service_4_select").val(FNPS?.fnps_service_4);
    $(".fnps_service_5_select").val(FNPS?.fnps_service_5);
    $(".fnps_service_6_select").val(FNPS?.fnps_service_6);
  }
});
