# Redirector - GUI Redirection based on Device ID

This repository contains examples on how to implement GUI redirection based on the actual devices unique identifier.

## HTTP Headers
When iViewer issues its request for the GUI file, it includes the following HTTP headers for your server to use if needed:

* cf-client: iViewer
* cf-client-version: v4.0.194 build 194
* cf-client-screensize: width,height
* cf-hardware: iPad
* cf-hardware-os: iPhone OS
* cf-hardware-os-version: 5.0.1
* cf-hardware-uuid: device ID here (if iOS allows applications access, otherwise it's the same as cf-uuid)
* cf-uuid: new unique identifier used by CommandFusion for device registration (due to Apple removing access to hardware ID in recent iOS releases)
* cf-new-udid: This header is being phased out in future iViewer versions. Same as cf-uuid.
* cf-old-udid: Depending on the access level iOS offers applications, this could contain the hardware ID or the CommandFusion device ID.

Of course the exact client, version, screensize, etc, will be reflective of the actual iViewer version being used, and the device requesting the file.

## Using the Headers

So based on this Device ID, we could redirect the request to an entirely new file on the same server, or even an entirely different server if wanted, via [URL Redirection](http://en.wikipedia.org/wiki/URL_redirection#Using_server-side_scripting_for_redirection)

## Why do this?

This effectively allows you to assign the exact same URL to all your client's devices, across all your projects, and handle the correct GUI file loading on the server side.

Then if you need your client to reload the GUI for some reason (perhaps their kid deleted the app by mistake) all they have to do is turn on the Reload options in iViewer settings.

Perhaps your client wants to load the GUI onto an additional device, all you would have to do is load the device registration code into the GUI on your server, then add the new device ID to your redirector script.  
Get the client to install the app, enter the URL and reload settings, and they are good to go. No truck roll required for fixes, new controllers, or client mess ups.