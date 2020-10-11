/**
 * jspsych-survey-likert
 * a jspsych plugin for measuring items on a likert scale
 *
 * Josh de Leeuw
 *
 * documentation: docs.jspsych.org
 *
 */

jsPsych.plugins['survey-likert-RAS'] = (function() {

  var plugin = {};

  plugin.trial = function(display_element, trial) {

    // default parameters for the trial
    trial.preamble = typeof trial.preamble === 'undefined' ? "" : trial.preamble;

    // if any trial variables are functions
    // this evaluates the function and replaces
    // it with the output of the function
    trial = jsPsych.pluginAPI.evaluateFunctionParameters(trial);

    // show preamble text
    display_element.append($('<div>', {
      "id": 'jspsych-survey-likert-preamble',
      "class": 'jspsych-survey-likert-preamble'
    }));

    $('#jspsych-survey-likert-preamble').html(trial.preamble);

    display_element.append('<form id="jspsych-survey-likert-form">');
    // add likert scale questions
    for (var i = 0; i < trial.questions.length; i++) {
      form_element = $('#jspsych-survey-likert-form');
      // add question
      form_element.append('<label class="jspsych-survey-likert-statement">' + trial.questions[i] + '</label>');
      // add options
      var width = 100 / trial.labels[i].length;
      options_string = '<ul class="jspsych-survey-likert-opts" data-radio-group="Q' + i + '">';
      options_string2 = '<ul class="RAS-likert">';//RAS added to mimic line above but only labels (for high and low)
      for (var j = 0; j < trial.labels[i].length; j++) {
        //RAS on line below added ' required'...no quotes.  This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response
        //RAS except then, didn't want the default browser response of selecting the first radio option and saying please indicate..etc... so removed it.  It is now exactly how it started (for just the line below)
        options_string += '<li style="width:' + width + '%"><input type="radio" name="Q' + i + '" value="' + j + '"><label class="jspsych-survey-likert-opt-label">' + trial.labels[i][j] + '</label></li>';
        options_string2 += '<li style="width:' + width + '%"><label class="RAS-likert-label">' + trial.labels2[i][j] + '</label></li>'; //RAS added to mimic line above but only labels (for high and low)
      }
      options_string += '</ul>';
      options_string2 += '</ul>';//RAS added to mimic line above but only labels (for high and low)
      
      form_element.append(options_string);
      form_element.append(options_string2);//RAS added to mimic line above but only labels (for high and low)
    }

    //// add submit button //RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    //display_element.append($('<button>', {//RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    //  'id': 'jspsych-survey-likert-next',//RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    //  'class': 'jspsych-survey-likert jspsych-btn button_likert_submit' // RAS added button_likert_submit to help with css //RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    //}));//RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    //$("#jspsych-survey-likert-next").html('Submit'); // RAS changed the content of the button text//RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    //$("#jspsych-survey-likert-next").click(function() {//RAS remove because trying to force a response. This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response 
    
    // RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response
    form_element.append($('<input>', {// RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response
      'type': 'submit',// RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response
      'class': 'jspsych-survey-likert jspsych-btn-RAS',// RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response // RAS jspsych-btn-RAS, instead of jspsych-btn for css referencing separately
      'value': 'Submit'// RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response// RAS changed the content of the button text
    }));// RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response

    form_element.submit(function(event) { // RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response

      event.preventDefault(); // RAS This is directly from the jspsych help forum thread "Modification of the jspsych-survey-likert-plugin for the "required" parameter".  To force a response
      
      if ($("input[name='Q0']:checked").val()) { //RAS this will only work if there is only 1 question level (because then all are named Q0 and can refer to the name directly as Q0).  This line checks if a radio button is selected at all

        // measure response time
        var endTime = (new Date()).getTime();
        var response_time = endTime - startTime;
  
        // create object to hold responses
        var question_data = {};
        $("#jspsych-survey-likert-form .jspsych-survey-likert-opts").each(function(index) {
          var id = $(this).data('radio-group');
          var response = $('input[name="' + id + '"]:checked').val();
          if (typeof response == 'undefined') {
            response = -1;
          }
          var obje = {};
          obje[id] = response;
          $.extend(question_data, obje);
        });
  
        // save data
        var trial_data = {
          "rt": response_time,
          "responses": JSON.stringify(question_data),//RAS added comma
          "stimulus": trial.questions[0]//RAS added so that the word wil be there.  Works with 0 as long as only one question/word per page
        };
  
        display_element.html('');
  
        // next trial
        jsPsych.finishTrial(trial_data);
      
      } else { //RAS added to enclose the code to execute submit if a response is selected
        alert("Please indicate your confidence in your previous response");//RAS added to ask for a confidence response if not selected
      }//RAS added to ask for a confidence response if not selected
    });

    var startTime = (new Date()).getTime();
  };

  return plugin;
})();








