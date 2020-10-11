/**
 * jspsych-survey-text
 * a jspsych plugin for free response survey questions
 *
 * Josh de Leeuw
 *
 * documentation: docs.jspsych.org
 *
 */


jsPsych.plugins['survey-text-RAS-CR'] = (function() {

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

    // set default values for the parameters  // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    trial.timing_response = trial.timing_response || -1; // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    
    // this array holds handlers from setTimeout calls // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    // that need to be cleared if the trial ends early // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    var setTimeoutHandlers = []; // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing

    trial.experimentCondition = trial.experimentCondition;//RAS added to log experiment test #
    var experimentConditionVariable = trial.experimentCondition[0];//RAS added to log experiment test #
    
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
      $("#jspsych-survey-text-" + i).append(trial.questions[i]); //RAS change
     // $("#jspsych-survey-text-" + i).append('<p class="jspsych-survey-text">' + trial.questions[i] + '</p>'); //RAS remove
      
      // add text box
      $("#jspsych-survey-text-" + i).append('<textarea name="#jspsych-survey-text-response-' + i + '" cols="' + trial.columns[i] + '" rows="' + trial.rows[i] + '"></textarea>');
      $('textarea').focus(); // RAS added
    }

    //// add submit button // RAS removed the submit button and instead added timeout that can be specified
    //display_element.append($('<button>', { // RAS removed the submit button and instead added timeout that can be specified
    //  'id': 'jspsych-survey-text-next', // RAS removed the submit button and instead added timeout that can be specified
    //  'class': 'jspsych-btn jspsych-survey-text' // RAS removed the submit button and instead added timeout that can be specified
    //})); // RAS removed the submit button and instead added timeout that can be specified
    //$("#jspsych-survey-text-next").html('Submit Answers'); // RAS removed the submit button and instead added timeout that can be specified
    //$("#jspsych-survey-text-next").click(function() { // RAS removed the submit button and instead added timeout that can be specified
    
    
    // store response
    var response = { // RAS ADD FROM SINGLE-STIM for onset RT
      rt: -1, // RAS ADD FROM SINGLE-STIM for onset RT
      key: -1 // RAS ADD FROM SINGLE-STIM for onset RT
    }; // RAS ADD FROM SINGLE-STIM for onset RT
    
    //RAS added Idea from StackOverflow.  Listens for an enter to be pressed and prevents the default behavior
    //RAS modify to allow for removing event listeners (no longer an anonymous function)
    var keyDownFunctionEvent = function(event) {//RAS added (listens for enter and space press in line below):  Idea from stackoverflow
      if (event.which == 13 || event.which == 32) {//RAS added Idea from stackoverflow and changed from keyCode to which
        event.preventDefault();//RAS added Idea from stackoverflow
      } 
    };
    
    $('textarea').keydown(keyDownFunctionEvent);//RAS added Idea from stackoverflow
    
    // function to end trial when it is time // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    var end_trial = function() { // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
		
      // kill any remaining setTimeout handlers // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
      for (var i = 0; i < setTimeoutHandlers.length; i++) { // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
        clearTimeout(setTimeoutHandlers[i]); // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
      } // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
      
      //RAS add to remove event listener for Keydown event at the end of the trial
      $('textarea').off("keydown",keyDownFunctionEvent);//RAS added Idea from stackoverflow
      
      // kill keyboard listeners // RAS ADD FROM SINGLE-STIM for onset RT
      if (typeof keyboardListener !== 'undefined') {// RAS ADD FROM SINGLE-STIM for onset RT
        jsPsych.pluginAPI.cancelKeyboardResponse(keyboardListener);// RAS ADD FROM SINGLE-STIM for onset RT
      }// RAS ADD FROM SINGLE-STIM for onset RT
     
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
        "experimentCondition": experimentConditionVariable,//RAS added to log experiment test #
        "responses": JSON.stringify(question_data), // RAS added comma
        "stimulus": trial.questions[0],//RAS added; CONCERN: as long as only single question per page.
        "reaction_time_firstAtoZ_keydown": response.rt, // RAS added for first keydown. == -1 if none.// RAS ADD FROM SINGLE-STIM for onset RT
        "key_press": response.key // RAS ADD FROM SINGLE-STIM for onset RT
      };
	
      display_element.html('');

      // next trial
      jsPsych.finishTrial(trialdata);
    }; // RAS was });  NOW is }; because took away the button click function 
	
	// function to handle responses by the subject // RAS ADD FROM SINGLE-STIM for onset RT
    var after_response = function(info) { // RAS ADD FROM SINGLE-STIM for onset RT

      // after a valid response, the stimulus will have the CSS class 'responded' // RAS ADD FROM SINGLE-STIM for onset RT
      // which can be used to provide visual feedback that a response was recorded // RAS ADD FROM SINGLE-STIM for onset RT
     // $("#jspsych-single-stim-stimulus").addClass('responded'); // RAS ADD FROM SINGLE-STIM for onset RT RAS comment out

      // only record the first response // RAS ADD FROM SINGLE-STIM for onset RT
      if (response.key == -1) { // RAS ADD FROM SINGLE-STIM for onset RT
        response = info; // RAS ADD FROM SINGLE-STIM for onset RT
      } // RAS ADD FROM SINGLE-STIM for onset RT
		
    //  if (trial.response_ends_trial) { // RAS ADD FROM SINGLE-STIM for onset RT // RAS comment out
    //    end_trial(); // RAS ADD FROM SINGLE-STIM for onset RT // RAS comment out
    //  } // RAS ADD FROM SINGLE-STIM for onset RT // RAS comment out
    }; // RAS ADD FROM SINGLE-STIM for onset RT

    // start the response listener // RAS ADD FROM SINGLE-STIM for onset RT
   // if (JSON.stringify(trial.choices) != JSON.stringify(["none"])) { // RAS ADD FROM SINGLE-STIM for onset RT // RAS comment out
      var keyboardListener = jsPsych.pluginAPI.getKeyboardResponse({ // RAS ADD FROM SINGLE-STIM for onset RT
        callback_function: after_response, // RAS ADD FROM SINGLE-STIM for onset RT
        valid_responses: [65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122], // RAS ADD FROM SINGLE-STIM for onset RT // RAS CHANGE FROM: valid_responses: trial.choices,
        rt_method: 'date', // RAS ADD FROM SINGLE-STIM for onset RT
        persist: false, // RAS ADD FROM SINGLE-STIM for onset RT
        allow_held_key: false // RAS ADD FROM SINGLE-STIM for onset RT
      }); // RAS ADD FROM SINGLE-STIM for onset RT
    //} // RAS ADD FROM SINGLE-STIM for onset RT// RAS comment out
	
    var startTime = (new Date()).getTime();
    
    
    //MUST HAVE SET THIS FOR TRIALS TO ADVANCE // RAS added
    // end trial if time limit is set // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    if (trial.timing_response > 0) { // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
      var t2 = setTimeout(function() { // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
        end_trial(); // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
      }, trial.timing_response); // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
      setTimeoutHandlers.push(t2); // RAS added directly from jspsych-single-stim.js to enable timeout / trial timing
    }
    
  };

  return plugin;
})();
