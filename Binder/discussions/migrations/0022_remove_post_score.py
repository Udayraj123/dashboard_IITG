# -*- coding: utf-8 -*-
# Generated by Django 1.10a1 on 2016-07-09 12:43
from __future__ import unicode_literals

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('discussions', '0021_auto_20160708_1311'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='post',
            name='score',
        ),
    ]
