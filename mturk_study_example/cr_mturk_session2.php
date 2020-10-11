<!doctype html>
<html>
<head>
	<title>MCL Experiment</title>
	<script src="js/jquery.min.js">
	</script>
	<script src="jspsych-5.0.3/jspsych.js">
	</script>
	<script src="jspsych-5.0.3/plugins/jspsych-single-stim_RAS.js">
	</script>
	<!-- Needed for single-stim-RAS call -->
	<script src="jspsych-5.0.3/plugins/jspsych-survey-text_RAS_cuedRecall_New.js">
	</script>
	<!-- needed for survey-text-RAS-CR call-->
	<script src="jspsych-5.0.3/plugins/jspsych-survey-multi-choice-RAS.js">
	</script>
	<!-- Needed for final questions -->
	<script src="jspsych-5.0.3/plugins/jspsych-survey-text-RAS-button.js">
	</script>
	<!-- Needed for final questions -->
	<script src="jspsych-5.0.3/plugins/jspsych-html.js">
	</script>
	<!-- needed for debriefing call-->
	<link href="jspsych-5.0.3/css/jspsych.css" rel="stylesheet" type="text/css">
	</link>
</head>
<body>
<?php
    
    ?>
</body>
<script>
	// Get browser information
	function getBrowserInfo() 
	{ 
	      var ua = navigator.userAgent, tem, 
	      M = ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
	      if(/trident/i.test(M[1])) 
	      { 
	              tem=  /\brv[ :]+(\d+)/g.exec(ua) || []; 
	              return 'IE '+(tem[1] || ''); 
	      } 
	      if(M[1]=== 'Chrome') 
	      { 
	              tem= ua.match(/\b(OPR|Edge)\/(\d+)/); 
	              if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera'); 
	      } 
	      M = M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?']; 
	      if((tem= ua.match(/version\/(\d+)/i))!= null) 
	              M.splice(1, 1, tem[1]); 
	      return { 'browser': M[0], 'version': M[1] }; 
	} 
	
	var browserInfo = getBrowserInfo();
	
	/* Second check */
	// Opera 8.0+
	var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
	
	// Firefox 1.0+
	var isFirefox = typeof InstallTrigger !== 'undefined';
	
	// Safari 3.0+ "[object HTMLElementConstructor]" 
	var isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0 || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
	
	// Internet Explorer 6-11
	var isIE = /*@cc_on!@*/false || !!document.documentMode;
	
	// Edge 20+
	var isEdge = !isIE && !!window.StyleMedia;
	
	// Chrome 1+
	var isChrome = !!window.chrome && !!window.chrome.webstore;
	
	// Blink engine detection
	var isBlink = (isChrome || isOpera) && !!window.CSS;
	
	
	
	//IF STATEMENT:  1st and 2nd check the original browser check; 3rd and 4th check the second check
	if(browserInfo.browser !== 'Chrome' && browserInfo.browser !== 'Firefox' && !isChrome && !isFirefox) 
	{ 
	      
	      var wrong_browser = 
	      { 
	              type: 'single-stim-RAS', 
	              stimulus: 'This experiment only has support for Google Chrome or Mozilla Firefox.  Please reopen the experiment in one of those browsers.  Apologies for the inconvenience!',
	              is_html: true,
	              waitTime:5000
	                       
	      }; 
	      jsPsych.init({ 
	              timeline: [wrong_browser], 
	      }); 
	}
	else  // Code to run experiment 
	{ 
	
	  
	  //Obtain the subject ID 
	  var s0_subjectID = prompt("Please enter your MTurk ID:");
	  
	  // Check to make sure the MTurk ID field isn't empty/null and consists of only letters and numbers
	  while (s0_subjectID==="" || s0_subjectID===null || !(/^[a-z0-9]+$/i.test(s0_subjectID))){
	    s0_subjectID = prompt("Please enter your MTurk ID:");
	  }
	  
	  //Obtain the condition info
	  var participantCondition = "lowAssociatesCuedRecall";
	  
	  
	  	//The word lists
		var wordList = [
			"ROUTINE - METHOD",
			"PLIERS - NAILS",
			"SCIENTIST - GLASSES",
			"SILK - PURSE",
			"CELERY - TUNA",
			"RIM - BICYCLE",
			"LEDGE - WINDOW",
			"CONFERENCE - TROUBLE",
			"BISCUIT - DOUGH",
			"CREATURE - WOLF",
			"PUFF - KITTEN",
			"COUNTRY - FLAG",
			"CLAY - TENNIS",
			"DESK - PAPER",
			"SUM - ANSWER",
			"LUMP - GRAVY",
			"PIT - DEEP",
			"LADDER - LUCK",
			"HALL - LOBBY",
			"EXAM - TEXT",
			"MANAGEMENT - OFFICE",
			"CLOAK - SCARF",
			"CASHEW - HUT",
			"GATE - FENCE",
			"LIGHT - LAMP",
			"ELEVATOR - BUTTON",
			"RHYTHM - SECTION",
			"PHYSICIAN - NEEDLE",
			"COMFORT - SUPPORT",
			"MATTRESS - BACK",
			"CRUST - TOAST",
			"FAITH - SONG",
			"ABSENCE - KIDS",
			"FOUNTAIN - PENNY",
			"PIRATE - CAVE",
			"CIRCUS - WHEEL",
			"ROBE - TOWEL",
			"CENTER - OUTSIDE",
			"FLOWER - DAISY",
			"GRIP - TAPE",
			"HIKE - BOOTS",
			"BRANCH - LIBRARY",
			"POND - LILY",
			"SAUCER - COFFEE",
			"PARADE - DRUM"
		];
	  
	
	// The code below sets up stimulus blocks for experiment
	
	var completeTestListArray = [];
	var list1Words = wordList;
	var cueList = [];
	var targetList = [];
	
	//Split cue and target into two lists
	for (var l = 0; l < list1Words.length; l++){
		//get current word pair
		var endWord = list1Words[l].indexOf(" - ");
		cueList[l] = list1Words[l].substring(0,endWord); // substring starts at 0, and ends on index before endWord
		targetList[l] = list1Words[l].substring(endWord+3,list1Words[l].length); // substring starts at endWord+3 (for " - "), and ends on index before length (which is last index + 1)
	}
	
	var finalStimulusCueAndTarget = [];
	for (var m = 0; m < cueList.length; m++){
		   finalStimulusCueAndTarget[m] = "<div id = 'leftCue'><p>"+cueList[m]+"</p></div><div id = 'centerFix'><p>-</p></div>"; 
	}
	 
	for (var l = 0; l < finalStimulusCueAndTarget.length; l++) {
	 completeTestListArray.push({
		  questions: [finalStimulusCueAndTarget[l]],
		  is_html: true
	 });
	 console.log(completeTestListArray[l]);
	}
	
	var finalTestList = {
	 type: 'survey-text-RAS-CR',
	 is_html: true,
	 randomize_order: true, // Because not already randomized above
	 rows: [1],
	 columns: [15],
	 timing_response: 3500,// RAS must have this set for trial to work.
	 timing_post_trial: 1000, /* time between trials*/
	 timeline: completeTestListArray,
	 experimentCondition: ["CuedRecall_Day2_Test"],
	 on_finish: function() {
		 /* Get the current trial's data*/
		 var current_node_id = jsPsych.currentTimelineNodeID();
		 var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	
		 /* Get the given stimulus, subset for the cue only, and add data to last trial*/
		 var currentStimulus = currentData[0].stimulus;
		 cueStimulusOnly = currentStimulus.substring(23,currentStimulus.length-46);
		 jsPsych.data.addDataToLastTrial({formatted_stimulus: cueStimulusOnly});
	
		 /* Get the given response and add to the current trial data*/
		 var jsonResponse = JSON.parse(currentData[0].responses);
		 jsPsych.data.addDataToLastTrial({formatted_response: jsonResponse.Q0.toUpperCase()});
	
		 /* Find out what index the trial cue was, in order to get the corresponding correct answer using the same index*/
		 var indexOfTestTrial = finalStimulusCueAndTarget.indexOf(currentStimulus); /* Got the index*/
	
		 /* Add the actual correct response and full word to the current trial data*/
		 jsPsych.data.addDataToLastTrial({full_word: cueList[indexOfTestTrial]});
		 jsPsych.data.addDataToLastTrial({correct_response: targetList[indexOfTestTrial]});
	
	
		 /* Get an updated version of the data*/
		 currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
		 
		 /* Check if response is correct*/
		 var correct;
	
		 if(currentData[0].formatted_response.toLowerCase().indexOf(currentData[0].correct_response.toLowerCase().substring(0,3)) >= 0) {
		   correct=1;
		 }
		 if(currentData[0].formatted_response.toLowerCase().indexOf(currentData[0].correct_response.toLowerCase().substring(0,3)) < 0) {
		   correct=0;
		 }
	
		 /* Add whether trial is correct or not*/
		 jsPsych.data.addDataToLastTrial({correct: correct});
		
		 //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)*/
		 var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
		 jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	
		 /* Get an updated version of the data*/
		 currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	
		 /* Saving current trial data only*/
		 save_data(currentData);
	 }
	};
	
	
	
	  // The code below defines each experimental block to be added to the timeline 
	  
	  var s1_welcome = {
	    type: "single-stim-RAS",
	    stimulus: "Thank you for continuing in the study!<br><br>Press any key to continue with the instructions.",
	    is_html: true,
	    waitTime: 1000,
	    on_finish: function() {/* Saving current trial only*/
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      
	      //Add subject# and condition# info and session# (2) info
	      jsPsych.data.addProperties({subjectID:""+s0_subjectID});
	      jsPsych.data.addProperties({conditionNumber:""+participantCondition});
	      jsPsych.data.addProperties({session_number:""+"2"});
	      jsPsych.data.addProperties({startTime:""+jsPsych.startTime()});//ADDED FOR MTURK
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session2_welcome"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      //Get updated version of data to save
	      currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      
	      save_data(currentData);
	    }
	  };
	  
	  
	  var s2_instructions_Mturk = {
	    type: "single-stim-RAS",
	    stimulus: "<b>We appreciate your interest in our study.  In order to collect high quality data, we ask that:</b><br>" +
	          "<p style='text-align:left;'>(1) You complete the study in a quiet place, free of distractions.<br>" +
	          "(2) You close all other browser tabs.<br>" +
	          "(3) You continue only if you can complete the session uninterrupted for approximately 5 to 10 minutes.<br><p style='text-align:left;'>" +
	          "<b>Press any key if you would still like to continue at this time.</b>",
	    is_html: true,
	    waitTime: 5000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session2_MTURK_instructions"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	
	    
	  var instructions_beforeFinalTestA = {
	    type: "single-stim-RAS",
	    stimulus: "In today's portion of the study, we will ask you to complete one " +
	    		"test just like the tests you completed approximately two days ago.<br><br>" +
	          "Press any key when you are ready to continue with the instructions.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeFinalTestA"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	  
	  var instructions_beforeFinalTestB = {
	    type: "single-stim-RAS",
	    stimulus: "Specifically, we will again provide you with the first word of each word pair you saw approximately two days ago. " +
	          "Please type the word that was paired with it in the blank provided. "+ 
	          "For a given word, if you cannot remember the corresponding word, just leave it blank.<br><br>"+
	          "You will have 3.5 seconds to complete each word.<br><br>" +
	          "Press any key when you are ready to <b>BEGIN</b> with the first word.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeFinalTestB"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	  
	
	  var finalQuestions_instruction = {
	    type: "single-stim-RAS",
	    stimulus: "Lastly, please answer the following 16 questions as honestly as you can.<br><br>Your answers will <b>NOT</b> affect your compensation."+
	    "<br><br>After responding to a given question, click the <b>Submit</b> button at the bottom of the screen to continue to the next question.  You may have to <b>scroll down</b> to reach the submit button."+
	    "<br><br>Press any key when you are ready to begin with the final questions.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_instructions"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	  
	  var fq_difficulty = {
	      type: 'survey-multi-choice',
	      questions: ['How difficult did you find this task?'],
	      options: [["Very easy", "Somewhat easy","Neither easy nor difficult","Somewhat difficult","Very difficult"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_difficulty"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_effort = {
	      type: 'survey-multi-choice',
	      questions: ['How much effort did you put into completing this task?'],
	      options: [["Hardly any effort at all", "A bit of effort","Medium effort","A good amount of effort","A great deal of effort"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_effort"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_note = {
	      type: 'survey-multi-choice',
	      questions: ['Did you note down any words (e.g. on a piece of paper) to help on the memory test (during the session today, or any time after the previous session)? (Your answer will NOT affect your compensation.)'],
	      options: [["Didn't note any","Noted down the occasional word","Noted down about half of the words","Noted down most of the words","Noted down all of the words"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_notedWords"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_noise = {
	      type: 'survey-multi-choice',
	      questions: ['How quiet was the environment you were in when you completed this task?'],
	      options: [["Very loud","Somewhat loud","Neither loud nor quiet","Somewhat quiet","Very quiet"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_noise"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_breaks = {
	      type: 'survey-multi-choice',
	      questions: ['How many breaks did you take during the task (0 = no breaks)?'],
	      options: [["0", "1","2","3","4","5","5+"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_breaksTaken"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	
	  var fq_location = {
	    type: 'survey-text-RAS-button',
	    questions: ["In what kind of setting did you complete this task (i.e. work, home, library, coffee shop, etc)?"],
	    on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_location"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	  };
	  
	
	  var demographics_instruction = {
	    type: "single-stim-RAS",
	    stimulus: "Next, we would like to collect some information from you in an effort to "+
	    "help us characterize the sample of participants who sign up for our research studies.  "+
	    "Note that the questions about ethnicity are not tied to our experimental hypotheses or "+
	    "results nor will they be reported on an individual subject basis.  Instead, reports regarding "+
	    "ethnicity will be based on cumulative responses calculated across all participants.<br><br>"+
	    "Press any key when you are ready to begin with the final 10 questions.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_instructions_demographic"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	
	  var fq_disorder = {
	      type: 'survey-multi-choice',
	      questions: ['Do you have any neurological disorders?'],
	      options: [["Yes", "No","I don't know","Prefer to not respond"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_disorder"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	    
	
	  var fq_age = {
	    type: 'survey-text-RAS-button',
	    questions: ["How old are you? (Please enter your age in digits)"],
	    on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_age"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	  };
	  
	
	  var fq_schooling = {
	    type: 'survey-text-RAS-button',
	    questions: ["How many years of schooling have you completed? (Please enter a number 1-25 or 25+. E.g. high school = 12, bachelors = 16)"],
	    on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_yearsOfSchool"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	  };
	  
	  var fq_vision = {
	      type: 'survey-multi-choice',
	      questions: ['Do you have normal (or corrected to normal) vision?'],
	      options: [["Yes","No"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_vision"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_hearing = {
	      type: 'survey-multi-choice',
	      questions: ['Do you have normal (or corrected to normal) hearing?'],
	      options: [["Yes","No"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_hearing"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_gender = {
	      type: 'survey-multi-choice',
	      questions: ['What is your gender identity?'],
	      options: [["Male", "Female","Other"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_gender"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_nativeLanguage = {
	      type: 'survey-multi-choice',
	      questions: ['Is English your native language?'],
	      options: [["Yes", "No"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_nativeLanguageEnglish"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  
	  var fq_race = {
	      type: 'survey-multi-choice',
	      questions: ['Please select one of the following racial categories that applies to you (please select the "More than one race" option if more than one category applies to you):'],
	      options: [["Black/ African American", "Asian","American Indian/ Alaska Native","Caucasian","Native Hawaiian/ Pacific Islander","Other","More than one race"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_race"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  var fq_hispanic = {
	      type: 'survey-multi-choice',
	      questions: ['Do you consider yourself to be Hispanic or Latino?'],
	      options: [["Yes","No","Prefer not to respond"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_hispanic"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	      
	  var fq_contact = {
	      type: 'survey-multi-choice',
	      questions: ['May we contact you in the future to invite you to complete further studies?'],
	      options: [["Yes", "No"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session2_finalQuestions_contact"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	      
	  };
	  
	  
	  var s3_finish = {
	    type: "single-stim-RAS",
	    stimulus: "You have now completed the experiment.<br><br>Thank you for participating!<br><br>Please complete the form for this HIT.<br>PLEASE ENTER THE FOLLOWING SURVEY CODE WHEN YOU SUBMIT THIS HIT: <b>11516</b><br><br>" +
	          "Press any key to continue to a debriefing sheet that will tell you a bit about the study.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session2_thankYou"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	
	
	/* Modified from JsPsych Documentation */
	var show_debriefing = function(elem) { 
	  return true;
	};
	
	
	// declare the block.
	var trialDebriefing = {
	  type:'html',
	  url: "debriefing_page.html",
	  cont_btn: "start",
	  force_refresh: true,
	  check_fn: show_debriefing
	};
	
	
	  // create experiment timeline array
	  var timeline = [];
	  timeline.push(s1_welcome);
	  timeline.push(s2_instructions_Mturk);
	  timeline.push(instructions_beforeFinalTestA);
	  timeline.push(instructions_beforeFinalTestB);    
	  timeline = timeline.concat(finalTestList);
	  timeline.push(finalQuestions_instruction);
	  timeline.push(fq_difficulty);
	  timeline.push(fq_effort);
	  timeline.push(fq_note);
	  timeline.push(fq_noise);
	  timeline.push(fq_breaks);
	  timeline.push(fq_location);
	  timeline.push(demographics_instruction);
	  timeline.push(fq_disorder);
	  timeline.push(fq_age);
	  timeline.push(fq_schooling);
	  timeline.push(fq_vision);
	  timeline.push(fq_hearing);
	  timeline.push(fq_gender);
	  timeline.push(fq_nativeLanguage);
	  timeline.push(fq_race);
	  timeline.push(fq_hispanic);
	  timeline.push(fq_contact);
	  timeline.push(s3_finish);
	  timeline.push(trialDebriefing);
	  
	// data parameter should be either the value of jsPsych.data()
	// or the parameter that is passed to the on_data_update callback function for the core library
	// jsPsych.data() contains ALL data
	// the callback function will contain only the most recently written data.
	function save_data(data){
	   var data_table = "TABLE_NAME_HERE"; // change this for different experiments
	   $.ajax({
	      type:'post',
	      cache: false,
	      url: 'savedata.php', // change this to point to your php file.
	      // opt_data is to add additional values to every row, like a subject ID
	      // replace 'key' with the column name, and 'value' with the value.
	      data: {
	          table: data_table,
	          json: JSON.stringify(data),
	          //opt_data: {key: value} RAS remove
	      },
	      success: function(output) { console.log(output); } // write the result to javascript console
	   });
	}
	
	  
	  /* start the experiment */
	  jsPsych.init({
	    timeline: timeline,
	    on_finish: function() {
	 
	    }
	  });
	  
	}
</script>
</html>
