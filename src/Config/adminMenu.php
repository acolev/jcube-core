<?php

return [
  createMenuItem(name: 'Dashboard', icon: 'ri-home-line', link: "admin.dashboard"),
  createMenuItem(name: 'Staff', icon: 'ri-group-line', link: "admin.staff.index", active: ['admin.staff.*', 'admin.roles.*'], access: ':Read', children: [
    createMenuItem(name: 'Staff List', link: "admin.staff.index", access: ':Read'),
    createMenuItem(name: 'Roles', link: "admin.roles.index", access: ':Read'),
  ]),
  createMenuItem(name: 'Settings', children: [
    createMenuItem(name: 'System Configuration', icon: 'ri-settings-line', link: ['admin.config.view', 'general'], active: ['admin.config*'], access: ':Read'),
    createMenuItem(name: 'Email/SMS Settings', icon: 'ri-mail-send-fill', link: '#', active: ['admin.setting.notification*'], access: 'Notification Settings:Edit', children: [
      createMenuItem(name: 'Global Template', link: 'admin.setting.notification.global', access: 'Notification Settings:Edit'),
      createMenuItem(name: 'Email Settings', link: 'admin.setting.notification.email', access: 'Notification Settings:Edit'),
      createMenuItem(name: 'SMS Settings', link: 'admin.setting.notification.sms', access: 'Notification Settings:Edit'),
      createMenuItem(name: 'Notification Templates', link: 'admin.setting.notification.templates', access: 'Notification Settings:Edit'),
    ]),
    
    createMenuItem('Language Manager', 'ri-translate-2', 'admin.language.index', ['admin.language.index'], ':Edit'),
  ]),
  createMenuItem(name: 'Others', children: [
    createMenuItem(name: 'Clear Cache', icon: 'ri-refresh-line', link: "admin.system.optimize", access: 'Super User'),
  ]),
];
