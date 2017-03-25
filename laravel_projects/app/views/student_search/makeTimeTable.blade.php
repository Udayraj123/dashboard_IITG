<div class="container">
    <?php $timeSlots = C::get('stud.timeSlots');?>

    <div class="row">
        <div class="box" style="padding: 20px">
            <table class="table" style="font-family: Ubuntu;font-size: 20px;"> 
                <tr><td><span class="fa"> Day </span></td>
                    @foreach($timeSlots as $time)
                    <td> <span class="fa fa-clock-o">{{$time}}</span> </td>
                    @endforeach
                </tr>
                @foreach($studTimings as $day=>$dayTimings)
                <tr>
                    <td style="color: #123123">{{$day}}</td>
                    @foreach($timeSlots as $time)
                    <td style="color: #255255">
                     <!-- <span class="fa fa-clock-o">{{$time}}</span>  -->
                     @if(array_key_exists($time,$dayTimings))
                     <?php $timing = $dayTimings[$time]; ?>
                     <h3 style="color:green">{{$timing['name']}}</h3>
                     <h4>{{$timing['venue']}}</h4>
                     @endif
                 </td>
                 @endforeach
             </tr>
             @endforeach
         </table>
     </div>
 </div>
</div>