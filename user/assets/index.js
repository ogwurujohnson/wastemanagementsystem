$(() => {
  const currentDate = new Date();
  const weekDays = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
  const months = ['jan', 'feb', 'mar', 'apr', 'may', 'june', 'july', 'aug', 'sep', 'oct', 'nov', 'dec'];
  
  $('.date-block__day').text(weekDays[currentDate.getDay()]);
  $('.date-block__date').text(currentDate.getDate());
  $('.date-block__month').text(months[currentDate.getMonth()]);
  $('.year-block').text(currentDate.getFullYear());
  
  $('.calendar__empty--1 .date-block').removeClass('hidden');
  $('.calendar__empty--2 .clock').removeClass('hidden');
  $('.calendar__empty--3 .year-block').removeClass('hidden');
  
  for (let i=0; i<12; i++) {
    const year = currentDate.getYear(),
          month = i,
          daysCount = daysInMonth(month + 1, year),
          prevMonthDaysCount = daysInMonth(month, year),
          firstDay = new Date(year, month, 1),
          firstDayOfWeek = (firstDay.getDay() + 1);
    let j;
    for (j=0; j<firstDayOfWeek; j++) {
      let $e = $('.calendar__month--' + i +' .calendar__day__' + j);
      $e.text(prevMonthDaysCount - firstDayOfWeek + j + 1);
      $e.addClass('half-transparent');
      addBold($e, j);
    }
    for (;j<42 && j<firstDayOfWeek+daysCount;j++) {
      let $e = $('.calendar__month--' + i +' .calendar__day__' + j);
      $e.text(j - firstDayOfWeek + 1);
      addBold($e, j);
    }
    for (let k=0;j<42;k++,j++) {
      let $e = $('.calendar__month--' + i +' .calendar__day__' + j);
      $e.text(k + 1);
      $e.addClass('half-transparent');
      addBold($e, j);
    }
  }
  
  initLocalClocks();
});

const daysInMonth = (m, y) => /8|3|5|10/.test(--m)?30:m==1?(!(y%4)&&y%100)||!(y%400)?29:28:31;

const addBold = ($e, i) => {
  if (i % 7 == 5 || i % 7 == 6) {
    $e.addClass('bold');
  }
}

function initLocalClocks() {
  const date = new Date();
  const seconds = date.getSeconds();
  const minutes = date.getMinutes();
  const hours = date.getHours();

  const hands = [
    {
      hand: 'clock__hour__container',
      angle: (hours * 30) + (minutes / 2)
    },
    {
      hand: 'clock__minute__container',
      angle: (minutes * 6) + (seconds / 10)
    },
    {
      hand: 'clock__second__container',
      angle: (seconds * 6)
    }
  ];
  hands.forEach((hand) => {
    const elements = document.querySelectorAll('.' + hand.hand);
    Array.from(elements).forEach((element) => {
      element.style.transform = `rotateZ(${ hand.angle }deg)`;
    });
  });
}