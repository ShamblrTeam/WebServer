WebServer
=========

This fantastic piece of software handles the web server that receives user queries, etc.

The different classes found here are the different elements of what will be used for the timeline UI. The different elements are as follows: answer, audio, chat, link, photo, quote, text, and video. There is a base 'Timeline Element' class that is the parent class of the other classes previously mentioned. This class contains the properties used in order to create a timeline page with te results from the query.
When looking at each of the classes mentioned, they are all very similar in structure. They each have three member functions: construct, renderContentBody, and loadData.
Construct() initializes and loads the content for the particular type (ex: answer, text, etc.). RenderContentBody() generates the content being returned for the response page from the query, as well as the link to the post. LoadData() organizes and stores the content through the parent class and performs logic on 'content'.
The only ones that are somewhat different in their approach, yet keep the same structure, are video and audio because of the nature of that data and handling it. For video, for example, the handling of data in LoadData() and renderContentBody() are different with respect to grabbing the URL and attaching the video to the timeline so that one can watch the video straight on the timeline, rather than having to click on a link to the site.
Overall, this structure allows us to better organize the types of data being grabbed and used for the query, resulting in more effective use of particular data.

Use "php -S localhost:8000" to create a development webserver at the current working directory. (see http://www.php.net/manual/en/features.commandline.webserver.php).
