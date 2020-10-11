/**
 * jspsych-survey-text
 * a jspsych plugin for free response survey questions
 *
 * Josh de Leeuw
 *
 * documentation: docs.jspsych.org
 *
 */


jsPsych.plugins['survey-text'] = (function() {

  var plugin = {};

  plugin.trial = function(display_element, trial) {

    trial.preamble = typeof trial.preamble == 'undefined' ? "" : trial.preamble;
    if (typeof trial.rows == 'undefined') {
      trial.rows = [];
      for (var i = 0; i < trial.questions.length; i++) {
        trial.rows.push(1);
      }
    }
    if (typeof trial.columns == 'undefined') {
      trial.columns = [];
      for (var i = 0; i < trial.questions.length; i++) {
        trial.columns.push(40);
      }
    }

    // if any trial variables are functions
    // this evaluates the function and replaces
    // it with the output of the function
    trial = jsPsych.pluginAPI.evaluateFunctionParameters(trial);

    // show preamble text
    display_element.append($('<div>', {
      "id": 'jspsych-survey-text-preamble',
      "class": 'jspsych-survey-text-preamble'
    }));

    $('#jspsych-survey-text-preamble').html(trial.preamble);

    // add questions
    for (var i = 0; i < trial.questions.length; i++) {
      // create div
      display_element.append($('<div>', {
        "id": 'jspsych-survey-text-' + i,
        "class": 'jspsych-survey-text-question'
      }));

      // add question text
      $("#jspsych-survey-text-" + i).append('<p class="jspsych-survey-text">' + trial.questions[i] + '</p>');

      // add text box
      $("#jspsych-survey-text-" + i).append('<textarea name="#jspsych-survey-text-response-' + i + '" cols="' + trial.columns[i] + '" rows="' + trial.rows[i] + '"></textarea>');
      $('textarea').focus(); // RAS added
    }

    // add submit button
    //display_element.append($('<button>', { RAS remove button
    //  'id': 'jspsych-survey-text-next', RAS remove button
    //  'class': 'jspsych-btn jspsych-survey-text' RAS remove button
    //})); RAS remove button
    //$("#jspsych-survey-text-next").html('Submit Answers');RAS remove button
    //$("#jspsych-survey-text-next").click(function() { RAS remove and replace with below for enter key instead of button click
    $('textarea').keydown(function(event) {//RAS added instead of line above (listens for enter press):  Idea from stackoverflow
      
      if (event.keyCode == 13) {//RAS added
        // measure response time
        var endTime = (new Date()).getTime();
        var response_time = endTime - startTime;
  
        // create object to hold responses
        var question_data = {};
        $("div.jspsych-survey-text-question").each(function(index) {
          var id = "Q" + index;
          var val = $(this).children('textarea').val();
          var obje = {};
          obje[id] = val;
          $.extend(question_data, obje);
        });
  
        // save data
        var trialdata = {
          "rt": response_time,
          "responses": JSON.stringify(question_data),  // RAS added comma
          "stimulus": trial.questions[0]//RAS added; CONCERN: as long as only single question per page.
        };
  
        display_element.html('');
  
        // next trial
        jsPsych.finishTrial(trialdata);
      } //RAS added
    });

    var startTime = (new Date()).getTime();
  };

  return plugin;
})();
