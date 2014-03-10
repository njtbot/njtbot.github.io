---
layout: post
title:  "Remote Development on a BeagleBone Black"
date:   2014-03-07 11:05:02
categories: 
tags:
---

I've been wanting to experiment with the [VFP][1] floating point unit and [NEON][2] media engine in the latest ARM Cortex-A8 processors for a while now, as they're currently very cheap and accessible, but doing this over an SSH session on a command line was too scary (and painful) to comprehend.

Netbeans has excellent integration with Hudson builders (or Jenkins), remote SCM hooks (git, hg, svn) and also supports remote `C/C++ Build Hosts`. This seemed like the perfect way to execute remote code whilst retaining my sanity.

There seems to be a number of fixes and pitfalls whilst setting up your environment for this type of development, so here's a quick write up of my somewhat painful experience in getting this to work. I'm running Netbeans 7.4 beta on a Macbook Pro running OS X 10.8.4 and a revision B BeagleBone Black. 

# Setup 

Under Netbeans' 'Services' tab:

	'C/C++ Build Hosts' -> Right Click -> 'Add New Host...'

Both the usb0 bridge and ethernet have static IP addresses, as shown below -

	Hostname - 
		usb0 bridge - 192.168.7.2 
		ethernet    - 192.168.0.20           
	Login - root         
	Password - *blank*

Select the "Remember Password" option in the password window, otherwise Netbeans may refuse to connect. I'm running all this as root on the BBB as I'm lazy, but it'd be best to setup a new user out of the box e.g.

	root@beaglebone:~# adduser NEWUSER     

Netbeans will then connect to the board over SSH and scan for any existing toolchains. In my case, using a brand new BBB running Angstrom, the processor-specific GNU toolchain was found and populated into the `C/C++ Build Hosts` tree in Netbeans.

Upon running a build, Netbeans will connect to the remote host and try to map the build paths to the remote filesystem. In my case, I first had to map `/` on the BBB to `/Volumes/root/` under my Macbook by exposing the root filesystem of the beagle using Samba and a hacky `/etc/smb.conf` to allow public guests.

	opkg update && opkg install samba
	nano /etc/smb.conf

Mapping root allows you to access all files on the Beagleboard from Netbeans, rather than just the home directory for each user. From a security standpoint this is a terrible idea, but I treat my BBB as a dev host which I'm sure I'll reflash multiple times in the very near future. 

# Fix 1

Netbeans seems to assume any Linux distro is running on an `x86` core. They aren't, they're `armv7`, so should be running the `armv7` toolchain for gcc. This is prefixed as arm-gnu-linux-noeabi-, or possibly just gcc depending on the packages installed.

Because of this, Netbeans decided to call the remote build OS `GNU-Linux-x86` in the build path and project options, but `GNU-x86_64-Linux` in the Makefile. This led to a lot of problems and troubleshooting. If you take note of the path error Netbeans throws out, you should be able to find/replace the correct strings in the Makefile. Also, my local build system was prefixed as `Mac OS X` - at least it got that part correct.

# Possibly working...

If all went well, you should now be able to hit `Build` then `Run` and Netbeans will happily build your project on your network-accessible Beagleboard and show you the standard output from the BBB  in the `Output` pane of Netbeans.

# Fix 2

If any files are listed as missing, or claims of makefile targets not existing, then you may need to individually right click on each file under your project tree and select `Upload to root@192.168.0.20`. I haven't found a quick way around this yet on Mac. I believe Netbeans on Linux handles this correctly and uses `scp` to auto-update the remote host files. If you can find a way around it, shoot me an email.

Hopefully now, you'll have a working remote development system and you should be able to happily debug the remote target with no issues. 

NEON experimentation coming soon.

[1]: http://en.wikipedia.org/wiki/ARM_architecture#Floating-point_.28VFP.29 
[2]: http://en.wikipedia.org/wiki/ARM_architecture#Advanced_SIMD_.28NEON.29