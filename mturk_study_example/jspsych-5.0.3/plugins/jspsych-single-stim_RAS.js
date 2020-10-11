/**
 * jspsych-single-stim
 * Josh de Leeuw
 *
 * plugin for displaying a stimulus and getting a keyboard response
 *
 * documentation: docs.jspsych.org
 *
 **/


jsPsych.plugins["single-stim-RAS"] = (function() {

  var plugin = {};

  jsPsych.pluginAPI.registerPreload('single-stim', 'stimulus', 'image');

  plugin.trial = function(display_element, trial) {

    // if any trial variables are functions
    // this evaluates the function and replaces
    // it with the output of the function
    trial = jsPsych.pluginAPI.evaluateFunctionParameters(trial);

    // set default values for the parameters
    trial.choices = trial.choices || [];
    trial.response_ends_trial = (typeof trial.response_ends_trial == 'undefined') ? true : trial.response_ends_trial;
    trial.timing_stim = trial.timing_stim || -1;
    trial.timing_response = trial.timing_response || -1;
    trial.is_html = (typeof trial.is_html == 'undefined') ? false : trial.is_html;
    trial.prompt = trial.prompt || "";
    
    //RAS adding a trial.waitTime that can be specified.  This number will be used in order to set the time that
    //this code should wait before adding an eventListener that will advance the screen when a participant responds.
    //This enables the experimenter to allow a subject response to end a trial BUT NOT ALLOW this to happen for X milliseconds.
    //Default value is wait for 0 seconds (i.e. immediately allow a response to end the trial).
    //The RT for trials with this plugin is based on time after response is allowed!
    trial.waitTime = trial.waitTime || 0;//RAS added

    // this array holds handlers from setTimeout calls
    // that need to be cleared if the trial ends early
    var setTimeoutHandlers = [];

    // display stimulus
    if (!trial.is_html) {
      display_element.append($('<img>', {
        src: trial.stimulus,
        id: 'jspsych-single-stim-stimulus-RAS-instructions' // RAS change to jspsych-single-stim-stimulus-RAS-instructions from jspsych-single-stim-stimulus
      }));
    } else {
      display_element.append($('<div>', {
        html: trial.stimulus,
        id: 'jspsych-single-stim-stimulus-RAS-instructions' // RAS change to jspsych-single-stim-stimulus-RAS-instructions from jspsych-single-stim-stimulus
      }));
    }

    //show prompt if there is one
    if (trial.prompt !== "") {
      display_element.append(trial.prompt);
    }

    // store response
    var response = {
      rt: -1,
      key: -1
    };

    // function to end trial when it is time
    var end_trial = function() {

      // kill any remaining setTimeout handlers
      for (var i = 0; i < setTimeoutHandlers.length; i++) {
        clearTimeout(setTimeoutHandlers[i]);
      }

      // kill keyboard listeners
      if (typeof keyboardListener !== 'undefined') {
        jsPsych.pluginAPI.cancelKeyboardResponse(keyboardListener);
      }

      // gather the data to store for the trial
      var trial_data = {
        "rt": response.rt,
        "stimulus": trial.stimulus,
        "key_press": response.key
      };

      //jsPsych.data.write(trial_data);

      // clear the display
      display_element.html('');

      // move on to the next trial
      jsPsych.finishTrial(trial_data);
    };

    // function to handle responses by the subject
    var after_response = function(info) {

      // after a valid response, the stimulus will have the CSS class 'responded'
      // which can be used to provide visual feedback that a response was recorded
      $("#jspsych-single-stim-stimulus-RAS-instructions").addClass('responded'); // RAS change to jspsych-single-stim-stimulus-RAS-instructions from jspsych-single-stim-stimulus

      // only record the first response
      if (response.key == -1) {
        response = info;
      }

      if (trial.response_ends_trial) {
        end_trial();
      }
    };

//RAS do not allow the response listener to start until a certain amount of time has passed.
//Using code format from below concerning the "end trial if time limit is set" portion.
  if (trial.waitTime > 0) { //RAS added this
      var timeOutWaitFunction = setTimeout(function() {//RAS added this
        // start the response listener //RAS added this
        if (JSON.stringify(trial.choices) != JSON.stringify(["none"])) {//RAS added this
          var keyboardListener = jsPsych.pluginAPI.getKeyboardResponse({//RAS added this
            callback_function: after_response,//RAS added this
            valid_responses: trial.choices,//RAS added this
            rt_method: 'date',//RAS added this
            persist: false,//RAS added this
            allow_held_key: false//RAS added this
          });//RAS added this
        }//RAS added this
      }, trial.waitTime);//RAS added this
  } else {//RAS added this
    // start the response listener // RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
    if (JSON.stringify(trial.choices) != JSON.stringify(["none"])) {// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
      var keyboardListener = jsPsych.pluginAPI.getKeyboardResponse({// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
        callback_function: after_response,// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
        valid_responses: trial.choices,// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
        rt_method: 'date',// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
        persist: false,// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
        allow_held_key: false// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
      });// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
    }// RAS this used to be stand-alone.  I.e. was not in if/else statement and simply always executed right away.  
  }//RAS added this
  
    // hide image if timing is set
    if (trial.timing_stim > 0) {
      var t1 = setTimeout(function() {
        $('#jspsych-single-stim-stimulus-RAS-instructions').css('visibility', 'hidden'); // RAS change to jspsych-single-stim-stimulus-RAS-instructions from jspsych-single-stim-stimulus
      }, trial.timing_stim);
      setTimeoutHandlers.push(t1);
    }

    // end trial if time limit is set
    if (trial.timing_response > 0) {
      var t2 = setTimeout(function() {
        end_trial();
      }, trial.timing_response);
      setTimeoutHandlers.push(t2);
    }

  };

  return plugin;
})();
