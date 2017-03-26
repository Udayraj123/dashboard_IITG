from django.contrib import admin
from .models import loguser, course, document
# Register your models here.

admin.site.register(loguser)
admin.site.register(course)
admin.site.register(document)
