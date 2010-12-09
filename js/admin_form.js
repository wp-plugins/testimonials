jQuery(function () {
  jQuery('.colorpick').ColorPicker(
		{
			onChange:function(input, rgb, hex, c, d){
				jQuery(input).val(hex);
				grouponUpdatePreview();
			},
			color: jQuery(this).val()
		});
});

function formatDateForParse(date){
  date.replace(/-/g, '/').replace(/Z$/, "").split("T").join(" ");
}

function grouponUpdatePreview() {
  
  var formToFuncMappings = {"#author_txt_clr" : "authorTextColor",
  "#wauthor_txt_clr" : "wauthorTextColor",
  "#ipauthor_txt_clr" : "ipauthorTextColor",
  "#cmp_txt_clr" : "compnayTextColor",
  "#wcmp_txt_clr" : "wcompnayTextColor",
  "#ipcmp_txt_clr" : "ipcompnayTextColor",
  "#web_clr" : "websiteColor",
  "#wweb_clr" : "wwebsiteColor",
  "#ipweb_clr" : "ipwebsiteColor",
  "#tetm_txt_clr" : "testimonialTxtColor",
  "#wtetm_txt_clr" : "wtestimonialTxtColor",
  "#iptetm_txt_clr" : "iptestimonialTxtColor",};
  
  for(var field in formToFuncMappings) {
    this[formToFuncMappings[field]].call(this, jQuery(field).val());
  }
}

function authorTextColor(hex){
  jQuery("#author_txt_clr").css("background-color", "#"+hex);
}

function wauthorTextColor(hex){
  jQuery("#wauthor_txt_clr").css("background-color", "#"+hex);
}

function ipauthorTextColor(hex){
  jQuery("#ipauthor_txt_clr").css("background-color", "#"+hex);
}

function compnayTextColor(hex){
  jQuery("#cmp_txt_clr").css("background-color", "#"+hex);
}

function wcompnayTextColor(hex){
  jQuery("#wcmp_txt_clr").css("background-color", "#"+hex);
}

function ipcompnayTextColor(hex){
  jQuery("#ipcmp_txt_clr").css("background-color", "#"+hex);
}

function testimonialTxtColor(hex){
  jQuery("#tetm_txt_clr").css("background-color", "#"+hex);
}

function wtestimonialTxtColor(hex){
  jQuery("#wtetm_txt_clr").css("background-color", "#"+hex);
}

function iptestimonialTxtColor(hex){
  jQuery("#iptetm_txt_clr").css("background-color", "#"+hex);
}

function websiteColor(hex){
  jQuery("#web_clr").css("background-color", "#"+hex);
}

function wwebsiteColor(hex){
  jQuery("#wweb_clr").css("background-color", "#"+hex);
}

function ipwebsiteColor(hex){
  jQuery("#ipweb_clr").css("background-color", "#"+hex);
}

function fileBrowser(tfval){
				jQuery(document).ready(function($) {
					if(tfval == "image"){
						$("#tfImage").removeClass("tfImage");
						$("#tfImage").addClass("block");
						}
					else
						$("#tfImage").addClass("tfImage");
				});
			}