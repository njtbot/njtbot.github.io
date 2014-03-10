---
layout: post
title:  "Beaglebone Black and Mac Internet Sharing"
date:   2014-03-06 11:30:02
categories: 
---

It's been a challenge to get the ethernet USB bridge working correctly on my Beaglebone Black, so here are the steps I used to get the connection working on Mac OS X.


Remove default broken route     
`
route del 192.168.7.0 gw *      
`

Add new gateway (Mac host)     
`
route add default gw 192.168.7.1
`

Add in google nameserver for DNS resolution      
`
echo "nameserver 8.8.8.8" > /etc/resolv.conf
`

The `route` command takes a while to take effect, so leave your BBB alone for a couple of minutes. This is where I was jumping the gun.

I saw this command posted around some forums for enabling internet sharing in Linux using iptables -

`
sudo iptables -A POSTROUTING -t nat -j MASQUERADE            
`
`
sudo echo 1 | sudo tee /proc/sys/net/ipv4/ip_forward > /dev/null      
`

Converting this into Mac-friendly ipfw gives something like -

`
sudo /usr/sbin/natd -interface en2
`
`         
sudo /sbin/ipfw -f flush         
`
`
sudo /sbin/ipfw add divert natd all from any to any via en2       
`
`
sudo /sbin/ipfw add pass all from any to any        
`

Turn on IPv4 forwarding       

`
sudo sysctl -w net.inet.ip.forwarding=1       
`

Some VNC commands which didn't help me - 

`
x11vnc -bg -o %HOME/.x11vnc.log.%VNCDISPLAY -auth /var/run/gdm/auth-for-gdm*/database -display :0  -forever
`

`
x11vnc -bg  -auth /var/run/gdm/auth-for-gdm*/database -display :0  -forever -passwd test﻿
`