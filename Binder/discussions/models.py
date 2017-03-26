from django.db import models
from django.contrib.auth.models import User
from django.core.urlresolvers import reverse
from django.conf import settings
from django.utils.text import slugify
from comment.models import comment
from django.contrib.contenttypes.models import ContentType


class post(models.Model):
    title = models.CharField(max_length=120)
    content = models.TextField(default='')
    goingat = models.CharField(max_length=10, default='')
    comingback = models.CharField(max_length=10, default='')
    # slug = models.SlugField(unique=True)
    timestamp = models.DateTimeField(auto_now_add=True, auto_now=False)
    updated = models.DateTimeField(auto_now_add=False, auto_now=True)
    writer = models.ForeignKey(User, editable=True, blank=False, null=True)

    def __str__(self):
        return self.title

    def __unicode__(self):
        return self.title
    def __str__(self):
        return self.content
    def __unicode__(self):
        return self.content
    def get_absolute_url(self):
        return reverse("posts:detail", kwargs={"id":self.id})
    def get_url_to_list(self):
        return "/discussions/"
    @property
    def comments(self):
        instance = self
        qs = comment.objects.filter_by_instance(instance)
        return qs
    @property
    def get_content_type(self):
        instance = self
        content_type = ContentType.objects.get_for_model(instance)
        return content_type
