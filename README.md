# An approachable guide to running experiments online using JsPsych and MySQL
A step-by-step guide to be used alongside JsPsych’s online tutorials. This manual and tutorial was written with the aim of providing a starting point for online data collection for those with little-to-no programming experience.

Ruth Shaffer
May 2017

# Purpose

This folder contains a manual and tutorial for running experiments online using JsPsych and MySQL for data collection and is intended to be used alongside JsPsych's online tutorials. This manual and tutorial was written with the aim of providing an approachable starting point for online data collection for those with little-to-no programming experience.

This manual/tutorial was created in 2017 for use with JsPsych version 5.0.3. 


# Files

Presentation/tutorial at Memory and Cognition Lab meeting May 2017:
Presentation - Running Experiments Using jsPsych and MySQL - May 2017 - RuthShaffer.pdf

Manual PDF:
Manual - Running Experiments Using jsPsych and MySQL - May 2017 - RuthShaffer.pdf

JsPsych tutorial code (jspsych_tutorial):
This folder contains the online tutorial files provided by JsPsych version 5.0.3 (Copyright (c) 2015 Joshua R. de Leeuw) to go along with the presentation above (Presentation - Running Experiments Using jsPsych and MySQL - May 2017 - RuthShaffer.pdf)

MTurk study example (mturk_study_example):
This folder contains an example of a complete experiment run online on MTurk by Ruth Shaffer. This experiment was created using JsPsych libraries and documentation (version 5.0.3; Copyright 2015 Joshua R. de Leeuw). The experiment incorporates several features that are often needed for online data collection:

1. Checking for subject browser (Chrome / Mozilla)
2. Consenting in an external html form (via html plugin)
3. Obtaining and checking MTurk ID
4. Creating stimuli / html formatting
5. Online response scoring
6. Time stamps (UTC)
7. Final demographic and other questions we typically ask on MTurk
8. Some plugins I’ve changed (formatting/data logging/presentation changes)
	- any plugin with RAS in it means it’s a modified jsPsych plugin
	- so it may differ from online documentation
9. Note that the css has been altered (although I left name as is)

