# Installation

After cloning the project somewhere in your system.

The following can be added to the composer.json of the Wordpress site:

```json
"repositories": [
    {
        "type": "path",
        "url": "/path/to/cloned/repo",
    }
],
"require": {
    "rivera/inpsyde-test": "*"
}
```

Then simply run

```bash
composer update
```

# How to Use
Activate the plugin.

Depending on your permalink settings:

### With Plain Links

```code
http://wordpress-url/?pagename=inpsyde-test
```

### With Permalinks Activated
```code
http://wordpress-url/inpsyde-test
```

# Note on Composer Dependncies

The dependencies I chose to include for the test may seem excesive or over engineered.

However, none are doing work specific to the task for me, they are libraries that let me structure code up to modern standards and allow me to use principles such as dependency injection, interface type hinting and make my code testable.

To prove I stuck to the minimal I didn't use any classes for http requests, I simply wrapped curl (which makes my class less testable), and I am not using a templating engine, I am also just wrapping that require within a class.

# Note on FrontEnd

I chose Vue for the FE framework.

I made on purpose a call to the API on the backend, so that I could stick to the requirements on the task, and display skills on backend structure.

But I am not using that data on the frontend. I am populating the table from an AJAX call the the api directly on page load.

# Note on my solution

There is one thing that I did not like and I left comments on the code about that.

I resorted to an exit statement. I must say that this is due to my current limitations in thorough knowledge of Wordpress internal workings.

I assesed that the best way of hooking into the task was using parse_request but could't find how to stop wordpress processing stages in an alternative way.