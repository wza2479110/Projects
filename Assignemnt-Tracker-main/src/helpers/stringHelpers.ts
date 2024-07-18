const uppercase = (text: string) => {
  return text.toUpperCase();
}

const calcDaysLeft = (deadline: Date) => {
  const sec = deadline.getSeconds();
  const min = deadline.getMinutes();
  const hr = deadline.getHours();

  // copy deadline hr/min/sec to now
  const now = new Date();
  now.setSeconds(sec);
  now.setMinutes(min);
  now.setHours(hr);

  // calculate deadline in ms
  const result = deadline.getTime() - now.getTime();

  // calculate deadline in days
  const msInDay = 86400000;
  return Math.round(result/msInDay);
}

export { uppercase, calcDaysLeft };
