Configurations
==============

Service
-------
serviceClass: 	(string) Service class
isShared: 		(boolean) Either service is shared or not
options:	
	Constructor service
			className: 	(string) for Constructor service only - name of the class to instantiate
	Dependency injector service
			diClass:	(string) Injector class to use (default is StandardInjector)
			options: 	class: 						(string) class to instanciate
						properties: 				(configuration) properties to be set.
						constructorParameters : 	(array) for ReflectionInjector only
	Factory service
			factory:	(string) class name of factory
	Instance service
			instance:	(mixed) intance in itself

service Locator
---------------
[key]: 	(service configuration)

Dependency injector
-------------------
class: 						(string) class to instanciate
properties: 				(configuration) properties to be set.
constructorParameters : 	(array) for ReflectionInjector only

Dependency injection container
------------------------------
[key] : 	diclass: (string) Injector class to use (default is StandardInjector)
			options: 	class: 						(string) class to instanciate
						properties: 				(configuration) properties to be set.
						constructorParameters : 	(array) for ReflectionInjector only

Test
----
box : 	diClass:	(string) Injector class to use (default is StandardInjector)
		options:	class: 						(string) class to instanciate
					properties: 				(configuration) properties to be set.
					*constructorParameters : 	(array) for ReflectionInjector only
scenario: (string) scenario class name
