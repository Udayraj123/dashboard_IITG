from __future__ import unicode_literals
from django.contrib.auth.models import User
from django.db import models


class loguser(models.Model):
    user = models.ForeignKey(User,default=1)
    is_prof = models.BooleanField(default=False)

class course(models.Model):
    user = models.ManyToManyField(User, related_name='courses', null=True)
    title = models.CharField(max_length=100)

class document(models.Model):
    course = models.ForeignKey(course, on_delete=models.CASCADE, null=True)
    book_link = models.CharField(max_length=1000, default=None)
    lecture = models.FileField(default=None)
    tutorial = models.FileField(default=None)
    postedby = models.ForeignKey(User, on_delete=models.CASCADE, null=True)



