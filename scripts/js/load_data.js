/**
 * Plugin Name: Plekvetica
 * Plugin URI: https://www.plekvetica.ch/
 * Description: Frontend JS Functions.
 * Version: 1.1
 * Date: 2020-09-01
 * Author: Daniel Spycher
 * Required Frameworks: JQuery
 * 
 */

/** Easy Akkredi Button 
Event Handler for the Akkreditation Button
*/
$('.easy_akkredi_event').click(function(){
  var ed = get_akkredi_data(this);
  display_akkredi_overlay(ed);

});


/**
 * Filter the Table row and removes all the unnessecary data
 * @param {object} t - Table row data 
 * @returns {object} - [organi,event,eventData,name,mail]
 */
function get_akkredi_data(t){
  var organi = $(t).data('organiid');
  var event = $(t).data('eventid');
  var eventData = $('#'+event+'_akkredi_data').html().replace(/<span class="adminTools">\([0-9]*\)<\/span>/mg,'\r\n\t\t');
  eventData = eventData.replace(/<br>/mg,'').trim();
  var eventDate = $('#'+event+'_akkredi_date').html();

  // onSingle event
  eventData = eventDate+" - "+eventData; 

  var name = $(t).data('akkrediname');
  var mail = $(t).data('akkredimail');
  return [organi,event,eventData,name,mail];
}

**
 * Loads the template file and replaces the placeholders
 * Replaces: organi, event, eventdata, name, mail
 * Displays the data as a overlay with plekOverlay
 * @param {object} ed - Object given by the get_akkredi_data function 
 *
 */
function display_akkredi_overlay(ed){
  $.get('templates/easy-akkredi-form-template.html', function(template) {
    var data = {organi : ed[0], event : ed[1], eventdata : ed[2], name : ed[3], mail : ed[4]}
    var c = plekTemplate(template,data);
    plekOverlay("easyAkkrediOverlay","Easy Akkredi",c);
  });
}

