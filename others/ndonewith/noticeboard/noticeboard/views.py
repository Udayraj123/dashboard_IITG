from django.shortcuts import render,redirect
from models import notice
# Create your views here.


def nb(request):
    all_notices = notice.objects.all().order_by('-dateadded')
    context = {
        'all_notices': all_notices,
    }
    return render(request, 'nb.html', context)

def add(request):
    return render(request, 'add.html')

def post(request):
    heading = request.POST.get('heading')
    posted_by = request.POST.get('posted_by')
    type_choice = request.POST.get('type_choice')
    type = request.POST.get('type')
    content = request.POST.get('content')
    ntc = notice(heading=heading,posted_by=posted_by,type_choice=type_choice,type=type,content=content)
    ntc.save()
    all_notices = notice.objects.all()
    context = {
        'all_notices': all_notices,
    }
    return redirect(nb)