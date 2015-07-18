studentsController = function() { 
	
	
	function errorLogger(errorCode, errorMessage) {
			console.log(errorCode +':'+ errorMessage);
		}
		
	function successLogger()
	{
		console.log("success!");
	}
		
	var webPage;
	var initialised = false;
		
	return { 
		init : function(page, callback) { 
			if (initialised) {
				callback()
			} else {
				webPage = page;
				storageEngine.init(function() {
					storageEngine.initObjectStore('student', function() {
						studentsController.addShit();
						callback();
					}, errorLogger) 
				}, errorLogger);
 
				initialized = true;
			}

		},
		addShit: function(){
				var ShuyuanChen= {
					name : "陈姝媛",
					image : "Shuyuan.jpg",
					classes : ["English","Chinglish","Chinese"],
					rating: 5
				}
				var ShuyuanChen2= {
					name : "陈姝媛2",
					image : "Shuyuan.jpg",
					classes : ["English","Chinglish","Chinese"],
					rating: 5
				}
				var ShuyuanChen3= {
					name : "陈姝媛3",
					image : "Shuyuan.jpg",
					classes : ["English","Chinglish","Chinese"],
					rating: 5
				}
				storageEngine.save('student',ShuyuanChen,
					successLogger,errorLogger);
				storageEngine.save('student',ShuyuanChen2,
					successLogger,errorLogger);
				storageEngine.save('student',ShuyuanChen3,
					successLogger,errorLogger);
		},
		loadStudents : function(that) {
			
			var template =  _.template($('#topStudentsTBody').html());
			storageEngine.findAll('student', function(students){
				var trimmedStudents = [];
				for(var i = 0; i < 3; i++){
					trimmedStudents.push(students[i]);
				}
				$(that).html(template({students:trimmedStudents}));
			},errorLogger);
		} 
	}
} ();