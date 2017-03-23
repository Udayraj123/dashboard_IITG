from __future__ import unicode_literals

from django.db import models

# Create your models here.

class notice(models.Model):
    id = models.AutoField(primary_key=True)
    heading = models.CharField(max_length=2500)
    posted_by = models.CharField(max_length=2500)
    type_choice = models.CharField(max_length=2500)
    type = models.CharField(max_length=2500)
    content = models.CharField(max_length=250000)
    dateadded = models.DateTimeField(auto_now_add=True)
