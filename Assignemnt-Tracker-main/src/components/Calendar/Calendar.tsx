import { useState } from 'react';
import { DayPicker } from 'react-day-picker';
import '../../../node_modules/react-day-picker/dist/style.css';
import style from './calendar.module.css';

interface CalendarProps {
  setDeadline: Function;
  toggleCalendar: Function;
}

const Calendar = ({ setDeadline, toggleCalendar }: CalendarProps) => {
  const [selected, setSelected] = useState<Date>();

  return (
    <DayPicker
    mode="single"
      selected={selected}
      onSelect={setSelected}
      disabled={{before: new Date()}}
      onDayClick={day => {
        setDeadline(day);
        toggleCalendar();
      }}
      modifiersClassNames={{
        selected: style.selected
      }}
      styles={{
        month: {
          background: 'white',
          color: 'black',
          boxShadow: '1px 1px 10px 1px',
          borderRadius: '10px'
        }
      }}
    />
  );
}

export default Calendar;