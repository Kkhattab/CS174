Team Members:

Kareem Khattab : 009025692

Kevin Hou : 008345688


The site should consist of three main views: The Landing Page view, the Write Something view, the Read A Story view.

Landing View: 
	•	Centered h1 tag “Five Thousand Characters
	•	Title of the HTML page should be same as h1 tag “Five Thousand Characters” 
	•	A link underneath h1 tag “Write Something” that will navigate to the Write Something view
	•	Underneath link to Write Something, text says “Check out what people are writing…” 
	•	Form centered in middle of page underneath “Check out what people are writing…” with placeholder text “Phrase Filter” 
	•	Next to the form there should be a dropdown with default genre being “All Genres” that will pull genres from database
	•	A “Go” button will be to the right of the dropdown and form
	•	Beneath the Form, Dropdown and Button there should be 3 h3-titled ordered lists: Highest Rated, Most Viewed, and Newest. 
	•	Each ordered list should have the top ten items from the database tables 
	⁃	Highest Rated will have the highest rated Stories 
	⁃	Most viewed will have the Stories with most views 
	⁃	Newest will be based on most recent date (when story was saved)
	•	Each list item in the 3 ordered lists should be a link to the Story View which has the text and title of the story they clicked 
	•	The “Phrase Filter” will control how the three lists are filtered. Initially it is blank with place holder, and “All Genres” is selected. The filter will search for the title and if genre is selected only show the items on the three lists with that genre and title. 
	⁃	Example: 
	⁃	Suppose the Phrase Filter was "Cute Puppies" and the genre was Crime. Then the top ten lists items would be: the Highest Rated stories with title containing "Cute Puppies" in the Crime genre, the Most Viewed stories with title containing "Cute Puppies" in the Crime genre, and the Newest stories with title containing "Cute Puppies" in the Crime genre. 
	•	Store the the current value of the Phrase Filter and Genre in a session, so that if a user comes back the values are set to what they had the last time they visited the site. Your program should clean any data sent from the form.

Write Something View: 

	•	Title for this view should be “Five Thousand Characters - Write Something”
	•	h1 Tag centered “Five Thousand Characters - Write Something”
	•	“Five Thousand Characters” in this h1 tag should be a link that takes user back to Landing View
	•	Beneath h1 tag will be a form with 3 text fields, a select tag, and text area 
	⁃	First textfield should be labeled “Title” 
	⁃	Second textfield should be labeled “Author”
	⁃	Third text field should be labeled “Identifier”
	⁃	Select should be labeled “Genre” 
	⁃	Text Area should be labeled “Your writing” 
	•	Underneath the forms and text area, centered should be two buttons Reset and Save 
	⁃	Save will save the story to the database 
	⁃	Reset will clear the data from the forms 
	⁃	After saving the information they entered should still be in the current view
	•	The forms and text area will have maximum character lengths, this should be specified in a config.php
	⁃	text area will not exceed 5000 characters 
	⁃	an error should appear in some fashion, like a turning the text area border red and showing a label that says “data has exceed the maximum”
	•	If a user enters a Identifier into the Identifier label than all the data of that story should populate the forms. An Identifier can just be a integer that is randomly generated and attached to a story every time they are created in the Write Something view. 

Read A Story View: 
	•	When a user clicks on a story from Landing Page View (the three lists from above) they are taken to this view.
	•	Title "Five Thousand Characters - Story Title" 
	•	h1 tag centered "Five Thousand Characters - Story Title" 
	•	“Five Thousand Characters" in h1 tag takes you back to landing page 
	•	Beneath this centered in a div tag should appear the author, and beneath this the date the story was first saved. 
	•	Beneath the div there should be the text "Your rating:" followed by the numbers 1 to 5 and then "Average Rating:" followed by the current average rating. 
	•	If user has rated the story the numbers 1-5 should not be links, and the number they selected should be bolded. 
	•	If user has not rated the story the numbers 1-5 should be links and when user clicks the number to rate the database gets updated. 
	⁃	The two columns in the database row associated to the identifier of the story should be adjusted “SUM_OF_RATINGS_SO_FAR” and “NUMBER_OF_RATINGS_SO_FAR” 
	⁃	These are the two values that you will use to compute the average rating. So SUM_OF_RATINGS_SO_FAR / NUMBER_OF_RATINGS_SO_FAR
	•	On the  bottom of this view show in a sequence of paragraph tags the time stamp of when the story was last saved. So every time the text changes (someone edits the info of a story) add a new paragraph tag with when it was updated and the text at the time of the story being saved. 

Code Structure: 

folder 
	index.php 
	src 
		configs 
		controllers 
		models 
		resources 
		styles 
		views 
			elements 
			helpers 

Namespace: kareemkevin\hw3\…. 


The base Model class should have methods for performing the initial connection to the database. Only subclasses of View, Element, and Helper are allowed to render HTML. Subclasses of View are responsible for drawing one complete web page. The base class should have a public abstract method render($data) which is implemented in sub-classes.