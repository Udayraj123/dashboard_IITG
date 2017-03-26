# -*- coding: utf-8 -*-
# Generated by Django 1.10.5 on 2017-03-05 13:28
from __future__ import unicode_literals

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('Twitter', '0002_tweet_timestamp'),
    ]

    operations = [
        migrations.AddField(
            model_name='comment',
            name='timestamp',
            field=models.TimeField(auto_now_add=True, default=None),
            preserve_default=False,
        ),
        migrations.AlterField(
            model_name='useradd',
            name='profile_picture',
            field=models.FileField(upload_to=''),
        ),
    ]
