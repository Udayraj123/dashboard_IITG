# -*- coding: utf-8 -*-
# Generated by Django 1.10a1 on 2016-07-08 07:03
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('discussions', '0019_auto_20160708_1200'),
    ]

    operations = [
        migrations.AlterField(
            model_name='post',
            name='score',
            field=models.IntegerField(blank=True, default=0, null=True),
        ),
    ]
