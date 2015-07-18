classesController = function() { 
	
	
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
					storageEngine.initObjectStore('class', function() {
						classesController.addShit();
						callback();
					}, errorLogger) 
				}, errorLogger);
 
				initialized = true;
			}

		},
		addShit: function(){
				/*testing the storage engine*/
				var English = {
					name : "English101",
					teacher : "Ben Brostoff",
					image : "Koala.jpg",
					tags : ["English","History","AP"],
					rating: 3,
					distance: 2,
					price: 300,
					length: 2,
					numClasses: 4,
					studentLimit: 3,
					nativeSpeaker: true,
					inClassroom: false,
					isOpen: true
				}
				var History = {
					name : "AP US History",
					teacher : "Ben Artinian",
					image : "Koala.jpg",
					tags : ["English", "Cheap", "whoooore"],
					rating : 2,
					distance: 4,
					price: 200,
					length: 4,
					numClasses: 3,
					studentLimit: 5,
					nativeSpeaker: true,
					inClassroom: false,
					isOpen: false
				}
				var Grammar = {
					name: "English Grammar",
					teacher : "JoeBlow",
					image : "Koala.jpg",
					tags : ["Spanish", "贵", "foot"],
					rating : 5,
					distance: 1,
					price: 100,
					length: 40,
					numClasses: 25,
					studentLimit: 25,
					nativeSpeaker: false,
					inClassroom: true,
					isOpen: true
				}
				storageEngine.save('class',English,
					successLogger,errorLogger);
				storageEngine.save('class',History,
					successLogger,errorLogger);
				storageEngine.save('class',Grammar,
					successLogger,errorLogger);
		},
		loadPromoted : function(that) {
			
			var template =  _.template($('#promotedRow').html());
			storageEngine.findAll('class', function(classes){
				var trimmedClasses = [];
				for(var i = 0; i < 3; i++){
					trimmedClasses.push(classes[i]);
				}
				$(that).html(template({classes:trimmedClasses}));
				
			},errorLogger);
		},
		loadSearchResults : function(that){
			var template = _.template($('#searchResultsDivTemplate').html());
			storageEngine.findAll('class', function(classes){
				var trimmedClasses = [];
				for(var i = 0; i < 3; i++){
					trimmedClasses.push(classes[i]);
				}
				$(that).html(template({classes:trimmedClasses}));
			}, errorLogger);
		},	
		search : function(searchValue, that){
			var template = _.template($('#searchResultsDivTemplate').html());
			storageEngine.findAllWithProperty('class', searchValue, function(classes){
				var trimmedClasses = [];
				if (classes.length > 3){
					for(var i = 0; i < 3; i++){
						trimmedClasses.push(classes[i]);
					}
				}
				else{
					trimmedClasses=classes;
				}
				$(that).html(template({classes:trimmedClasses}));
			}, errorLogger);
		}
	}
} ();