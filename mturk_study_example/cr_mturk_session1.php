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
	<!-- needed for single-stim-RAS call-->
	<script src="jspsych-5.0.3/plugins/jspsych-single-stim-RAS-WordPairs.js">
	</script>
	<!-- needed for single-stim-RAS-WordPairs call-->
	<script src="jspsych-5.0.3/plugins/jspsych-survey-text_RAS_cuedRecall_New.js">
	</script>
	<!-- needed for survey-text-RAS-CR call-->
	<script src="jspsych-5.0.3/plugins/jspsych-html.js">
	</script>
	<!-- needed for consent call-->
	<script src="jspsych-5.0.3/plugins/jspsych-survey-multi-choice-RAS.js">
	</script>
	<!-- Needed for final questions -->
	<script src="jspsych-5.0.3/plugins/jspsych-survey-text-RAS-button.js">
	</script>
	<!-- Needed for final questions -->
	<link href="jspsych-5.0.3/css/jspsych.css" rel="stylesheet" type="text/css">
	</link>
</head>
<body>
<?php ?>
</body>
<script>
	
	
	// Checking for Chrome or Mozilla.  Otherwise asks user to switch to one of these  
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
	
	// Second check
	
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
	
	
	// Modified from JsPsych Documentation
	// sample function that can be used to check if a subject has given
	// consent to participate.
	var check_consent = function(elem) { 
	  return true;
	};
	
	
	// declare the block.
	var trialConsent = {
	  type:'html',
	  url: "consent_page2.html",
	  cont_btn: "start",
	  force_refresh: true,
	  check_fn: check_consent
	};
	  
	  //Obtain the subject ID 
	  var s0_subjectID = prompt("Please enter your MTurk ID:");
	  
	  // Check to make sure the MTurk ID field isn't empty/null and consists of only letters and numbers
	  while (s0_subjectID==="" || s0_subjectID===null || !(/^[a-z0-9]+$/i.test(s0_subjectID))){
	    s0_subjectID = prompt("Please enter your MTurk ID:");
	  }
	  
	  //Condition info
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
	  
	// Initialize experiment arrays
	var completeStudyListArray = [];
	var completeStudyListBlocks = [];
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
	
	// Create final stimulus list
	var finalStimulusCueAndTarget = [];
	for (var m = 0; m < cueList.length; m++){
		   finalStimulusCueAndTarget[m] = "<div id = 'leftCue'><p>"+cueList[m]+"</p></div><div id = 'centerFix'><p>-</p></div><div id = 'rightTarget'><p>"+targetList[m]+"</p></div>"; 
	}
	
	//Create the individual study trials based on the word list
	for (var l = 0; l < finalStimulusCueAndTarget.length; l++) {
	 completeStudyListArray.push({
		  stimulus: finalStimulusCueAndTarget[l],
		  is_html: true
	 });
	 console.log(completeStudyListArray[l]);
	}
			 
	
	//Create initial learning blocks
	for (var p = 1; p <= 5; p++) {	
		 completeStudyListBlocks[p-1] = {
			 type: 'single-stim-RAS-WordPairs',
			 is_html:true,
			 randomize_order: true, // Because not already randomized above
			 timing_response: 2000, // Works with "response_ends_trial: false" below.  Choose how long trial in ms here
			 response_ends_trial: false,
			 timing_post_trial: 1000, // time between trials
			 experimentCondition: ["Study_"+p],
			 timeline: completeStudyListArray,//because begins at 0
			 on_finish: function() {// Saving current trial only
	
				 //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
				 var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
				 jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
		   
				 // Get the current trial's data 
				 var current_node_id = jsPsych.currentTimelineNodeID();
				 var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
		   
				 save_data(currentData);
			 }
		 };
			 
	 }
	
	// Assign blocks to new variables
	var study1Words_trial = completeStudyListBlocks[0];
	var study2Words_trial = completeStudyListBlocks[1];
	var study3Words_trial = completeStudyListBlocks[2];
	var study4Words_trial = completeStudyListBlocks[3];
	var study5Words_trial = completeStudyListBlocks[4];     
	
	
	
	// Initialize test list arrays
	var completeTestListArray = [];
	var completeTestListBlocks = [];
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
	
	// Create final stimulus list
	var finalStimulusCueAndTarget = [];
	for (var m = 0; m < cueList.length; m++){
		   finalStimulusCueAndTarget[m] = "<div id = 'leftCue'><p>"+cueList[m]+"</p></div><div id = 'centerFix'><p>-</p></div>"; 
	}
	
	// Create test
	for (var l = 0; l < finalStimulusCueAndTarget.length; l++) {
	 completeTestListArray.push({
		  questions: [finalStimulusCueAndTarget[l]],
		  is_html: true
	 });
	 console.log(completeTestListArray[l]);
	}
	
	for (var r = 1; r <= 5; r++) {
	
		completeTestListBlocks[r-1] = {
		   type: 'survey-text-RAS-CR',
		   is_html: true,
		   randomize_order: true, // Because not already randomized above
		   rows: [1],
		   columns: [15],
		   timing_response: 3500,// RAS must have this set for trial to work.
		   timing_post_trial: 1000, /* time between trials*/
		   timeline: completeTestListArray,
		   experimentCondition: ["CuedRecall_Day1_Test_"+r],
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
		console.log(completeTestListBlocks[r-1]);
	}
	 
	var finalTest1List = completeTestListBlocks[0];
	var finalTest2List = completeTestListBlocks[1];
	var finalTest3List = completeTestListBlocks[2];
	var finalTest4List = completeTestListBlocks[3];
	var finalTest5List = completeTestListBlocks[4];
	
	   	
	// Each block below defines an experiment block (instructions, study, test,...)
	  
	  var s1_welcome = {
	    type: "single-stim-RAS",//The RT for trials with this plugin are based on RT after response is allowed
	    stimulus: "Welcome to the study.<br><br>Press any key to begin with the instructions.",
	    is_html: true,
	    waitTime: 1000,
	    on_finish: function() {/* Saving current trial only */
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      
	      //Add subject# and condition# info and session# (1) info
	      jsPsych.data.addProperties({subjectID:""+s0_subjectID});
	      jsPsych.data.addProperties({conditionNumber:""+participantCondition});
	      jsPsych.data.addProperties({session_number:""+"1"});
	      jsPsych.data.addProperties({startTime:""+jsPsych.startTime()});//ADDED FOR MTURK
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session1_welcome"});
	      
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
	          "(3) You continue only if you can complete the session uninterrupted for approximately 35 to 45 minutes.<br><p style='text-align:left;'>" +
	          "<b>Press any key if you would still like to continue at this time.</b>",
	    is_html: true,
	    waitTime: 5000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "study_MTURK_instructions"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	       
	
	  var instructions_beforeStudy1A = {
	    type: "single-stim-RAS",
	    stimulus: "In the first part of this experiment, you will be shown 45 pairs of words.<br><br>" +
	          "Each word pair will appear on the screen for 2 seconds.<br><br>" +
	          "Please pay attention to the word pairs, as your memory for " +
	          "them will be tested later.<br><br>" +
	          "Press any key when you are ready to continue with the instructions.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy1A"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeStudy1B = {
	    type: "single-stim-RAS",
	    stimulus: "Specifically, for each word pair, we will later provide you with the first word and ask that " +
	          "you remember the word it was paired with.<br><br>We will ask that you type "+
	          "the word in the blank provided.<br><br>In today's portion of the study, you will view and take tests on the word pairs 5 times.<br><br>" +
	          "Press any key when you are ready to continue with the instructions.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy1B"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeStudy1C = {
	    type: "single-stim-RAS",
	    stimulus: "As just noted on the previous page, you will view and take tests on the word pairs 5 times.<br><br>" +
	    		"Regardless of whether or not you remember a given word-pair correctly, you will restudy it and take tests on it again.<br><br>"+
	          "Press any key when you are ready to continue with the instructions.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy1C"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeStudy1D = {
	    type: "single-stim-RAS",
	    stimulus: "For now, we simply ask that you pay attention to the word pairs presented on the screen.<br><br>"+
	    "Press any key when you are ready to <b>BEGIN THE STUDY</b> by seeing a set of 45 word pairs.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy1D"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	
	  var instructions_beforeTest1 = {
	    type: "single-stim-RAS",
	    stimulus: "Next, we will provide you with the first word of each word pair. " +
	          "Please type the word that was paired with it in the blank provided. "+ 
	          "For a given word, if you cannot remember the corresponding word, just leave it blank.<br><br>"+
	          "You will have 3.5 seconds to complete each word.<br><br>" +
	          "Press any key when you are ready to begin with the first word.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeTest1"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeStudy2 = {
	    type: "single-stim-RAS",
	    stimulus: "You will now be shown the same 45 pairs of words you saw previously.<br><br>" +
	          "Each word pair will appear on the screen for 2 seconds.<br><br>" +
	          "Please pay attention to the word pairs, as your memory for " +
	          "them will be tested later with the same kind of test you just completed.<br><br>" +
	          "Press any key when you are ready to CONTINUE STUDYING the word pairs.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy2"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	  
	
	  var instructions_beforeTest2 = {
	    type: "single-stim-RAS",
	    stimulus: "Next, we will again provide you with the first word of each word pair. " +
	          "Please type the word that was paired with it in the blank provided. "+ 
	          "For a given word, if you cannot remember the corresponding word, just leave it blank. "+
	          "We realize you may have already correctly recalled some of these before. "+
	          "Please just do your best on each test.<br><br>"+
	          "You will have 3.5 seconds to complete each word.<br><br>" +
	          "Press any key when you are ready to begin with the first word.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeTest2"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	  
	
	  var instructions_beforeStudy3 = {
	    type: "single-stim-RAS",
	    stimulus: "You will now be shown the same 45 pairs of words you saw previously.<br><br>" +
	          "Each word pair will appear on the screen for 2 seconds.<br><br>" +
	          "Please pay attention to the word pairs, as your memory for " +
	          "them will be tested later with the same kind of test you just completed.<br><br>" +
	          "Press any key when you are ready to CONTINUE STUDYING the word pairs.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy3"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeTest3 = {
	    type: "single-stim-RAS",
	    stimulus: "Next, we will again provide you with the first word of each word pair. " +
	          "Please type the word that was paired with it in the blank provided. "+ 
	          "For a given word, if you cannot remember the corresponding word, just leave it blank. "+
	          "We realize you may have already correctly recalled some of these before. "+
	          "Please just do your best on each test.<br><br>"+
	          "You will have 3.5 seconds to complete each word.<br><br>" +
	          "Press any key when you are ready to begin with the first word.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeTest3"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeStudy4 = {
	    type: "single-stim-RAS",
	    stimulus: "You will now be shown the same 45 pairs of words you saw previously.<br><br>" +
	          "Each word pair will appear on the screen for 2 seconds.<br><br>" +
	          "Please pay attention to the word pairs, as your memory for " +
	          "them will be tested later with the same kind of test you just completed.<br><br>" +
	          "Press any key when you are ready to CONTINUE STUDYING the word pairs.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy4"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeTest4 = {
	    type: "single-stim-RAS",
	    stimulus: "Next, we will again provide you with the first word of each word pair. " +
	          "Please type the word that was paired with it in the blank provided. "+ 
	          "For a given word, if you cannot remember the corresponding word, just leave it blank. "+
	          "We realize you may have already correctly recalled some of these before. "+
	          "Please just do your best on each test.<br><br>"+
	          "You will have 3.5 seconds to complete each word.<br><br>" +
	          "Press any key when you are ready to begin with the first word.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeTest4"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeStudy5 = {
	    type: "single-stim-RAS",
	    stimulus: "You will now be shown the same 45 pairs of words you saw previously.<br><br>" +
	          "Each word pair will appear on the screen for 2 seconds.<br><br>" +
	          "Please pay attention to the word pairs, as your memory for " +
	          "them will be tested later with the same kind of test you just completed.<br><br>" +
	          "Press any key when you are ready to CONTINUE STUDYING the word pairs.",//CHANGED FOR MTURK
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeStudy5"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	
	  var instructions_beforeTest5 = {
	    type: "single-stim-RAS",
	    stimulus: "Next, we will again provide you with the first word of each word pair. " +
	          "Please type the word that was paired with it in the blank provided. "+ 
	          "For a given word, if you cannot remember the corresponding word, just leave it blank. "+
	          "We realize you may have already correctly recalled some of these before. "+
	          "Please just do your best on each test.<br><br>"+
	          "You will have 3.5 seconds to complete each word.<br><br>" +
	          "Press any key when you are ready to begin with the first word.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "instructions_beforeTest5"});
	      
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
	    stimulus: "Lastly, please answer the following 6 questions as honestly as you can.<br><br>Your answers will <b>NOT</b> affect your compensation."+
	    "<br><br>After responding to a given question, click the <b>Submit</b> button at the bottom of the screen to continue to the next question.  You may have to <b>scroll down</b> to reach the submit button."+
	    "<br><br>Press any key when you are ready to begin with the final questions.",
	    is_html: true,
	    waitTime: 3000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_instructions"});
	      
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
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_difficulty"});
	        
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
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_effort"});
	        
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
	      questions: ['Did you note down any words (e.g. on a piece of paper) to help on the memory test? (Your answer will NOT affect your compensation.)'],
	      options: [["Didn't note any","Noted down the occasional word","Noted down about half of the words","Noted down most of the words","Noted down all of the words"]],
	      required:[true],
	      horizontal:false,
	      on_finish: function() {
	        
	        //Entering condition information
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_notedWords"});
	        
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
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_noise"});
	        
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
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_breaksTaken"});
	        
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
	        jsPsych.data.addDataToLastTrial({experimentCondition: "session1_finalQuestions_location"});
	        
	        //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	        var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	        jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	        
	        var current_node_id = jsPsych.currentTimelineNodeID();
	        var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	        save_data(currentData);
	      }
	  };
	  
	  
	  
	  var s8_finish = {
	    type: "single-stim-RAS",
	    stimulus: "You have now completed this portion of the experiment!<br><br>" +
	          "Press any key to receive the submission instructions.",
	    is_html: true,
	    waitTime: 2000,
	    on_finish: function() { /* Saving current trial only */
	      
	      //Entering condition information
	      jsPsych.data.addDataToLastTrial({experimentCondition: "session1_completeFirstPortion"});
	      
	      //Adding end of trial timing information in UTC.  STL would be 6 hours before UTC (UTC -6)
	      var timestampUTC = (new Date).toISOString().replace(/z|t/gi,' ').trim();
	      jsPsych.data.addDataToLastTrial({endOfTrialTimeUTC: timestampUTC});
	      
	      var current_node_id = jsPsych.currentTimelineNodeID();
	      var currentData = jsPsych.data.getDataByTimelineNode(current_node_id);
	      save_data(currentData);
	    }
	  };
	  
	  var s8_finish_submission = {
	    type: "single-stim-RAS",
	    stimulus: "<p style='font-size:36px;line-height:43px;'>Please complete the form for this HIT.<br>PLEASE ENTER THE FOLLOWING SURVEY CODE WHEN YOU SUBMIT THIS HIT: <b>78366</b><br><br>" +
	          "Approximately <b><i>two days</i></b> from now, <i>you will receive an email with the link to the second session HIT.</i>"+
	          " You will have <i>24 hours</i> from receipt of that email <i>to complete the second session of this study</i>.<b> If you complete the second session of this study, you will receive an extra $5.00.</b><br><br>"+
	          "If you have any questions, please email <b>wustl.mcl@gmail.com</b><br><br>"+
	          "You may now close this window.<p>",
	    is_html: true,
	    waitTime: 60000,
	    on_finish: function() {
	      
	      //Do nothing
	      
	    }
	  };
	  
	
	  
	  
	  /* create experiment timeline array */
	  var timeline = [];
	
	  timeline.push(trialConsent);
	  timeline.push(s1_welcome);
	  timeline.push(s2_instructions_Mturk);
	  timeline.push(instructions_beforeStudy1A);
	  timeline.push(instructions_beforeStudy1B);
	  timeline.push(instructions_beforeStudy1C);
	  
	  timeline.push(instructions_beforeStudy1D);
		timeline.push(study1Words_trial);
	  
	  timeline.push(instructions_beforeTest1);
	  timeline = timeline.concat(finalTest1List);
	  
	  timeline.push(instructions_beforeStudy2);
	  timeline.push(study2Words_trial);
	  
	  timeline.push(instructions_beforeTest2);
	  timeline = timeline.concat(finalTest2List);
	  
	  timeline.push(instructions_beforeStudy3);
	  timeline.push(study3Words_trial);
	  
	  timeline.push(instructions_beforeTest3);
	  timeline = timeline.concat(finalTest3List);
	  
	  timeline.push(instructions_beforeStudy4);
	  timeline.push(study4Words_trial);
	  
	  timeline.push(instructions_beforeTest4);
	  timeline = timeline.concat(finalTest4List);
	  
	  timeline.push(instructions_beforeStudy5);
	  timeline.push(study5Words_trial);
	  
	  timeline.push(instructions_beforeTest5);
	  timeline = timeline.concat(finalTest5List);
	  
	
	  timeline.push(finalQuestions_instruction);
	  timeline.push(fq_difficulty);
	  timeline.push(fq_effort);
	  timeline.push(fq_note);
	  timeline.push(fq_noise);
	  timeline.push(fq_breaks);
	  timeline.push(fq_location);
	  timeline.push(s8_finish);
	  timeline.push(s8_finish_submission);
	  
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
