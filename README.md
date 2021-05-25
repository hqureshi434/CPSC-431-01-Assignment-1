# CPSC 431-01, Spring 2021 - Assignment 1
## Project By: 
* Adam Laviguer | adamlaviguer@csu.fullerton.edu
* Hammda Qureshi | qureshi434@csu.fullerton.edu

## Link to Web-App:
[Assignment 1] (http://ecs.fullerton.edu/~cs431s1/A1/)

### Introduction
The goal of the assignment was to create a simple photo gallery web-app in PHP. The web-app should satisfy these 4 use-cases:
1. User uploads new photo to photo album including meta data (Name, Date, Location, Photographer)
2. User views all photos currently in photo album as gallery
3. User chooses sorting method by selecting from choice of meta fields in dropdown
4. User can choose to upload additional photos from gallery screen (back to upload form)
We were able to successfully complete use cases 1, 2, and 4. We were unsuccessful in adding functionality to the "Sort By" dropdown in `gallery.php` and we were unsuccessul in displaying the meta data with each photo uploaded. There is also a known error where some images (with the correct file type) are unable to be uploaded in the web-app when we run the code on the school server. We did not implement a size limit for uploads, so we are not sure what is causing this error.

### Contribution breakdown:
* `index.html` UI: Adam Laviguer
* `gallery.php` UI: Hammad Qureshi
* *Photo Upload*: Adam Laviguer
* *Photo Display*: Adam Laviguer
* *Photo Sorting*: Hammad Qureshi
* *Meta Data Display*: Hammad Qureshi
