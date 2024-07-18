import Calendar from '../../components/Calendar/Calendar'
import styles from './header.module.css'
import { useState } from 'react'
import { AiOutlinePlusCircle } from 'react-icons/ai'
import { IoCalendar } from 'react-icons/io5'

interface AssignmentProperties {
  id: number;
  name: string;
  completed: boolean;
  deadline: Date;
}

interface HeaderProps {
  assignmentInput: string;
  setAssignmentInput: Function;
  assignments: AssignmentProperties[]
  setAssignments: Function;
  deadline: Date|undefined;
  setDeadline: Function;
}

const Header = ({ 
    assignmentInput, 
    setAssignmentInput, 
    assignments, 
    setAssignments,
    deadline,
    setDeadline }: HeaderProps) => {

  const [showCalendar, toggleCalendar] = useState(false);

  const onChange = (event: React.ChangeEvent<HTMLInputElement>) => {
    setAssignmentInput(event.currentTarget.value);
  }

  const onCreate = () => {
    setAssignments([
      ...assignments, 
      {
        id: Date.now(), 
        name: assignmentInput, 
        completed: false,
        deadline: deadline
      }
    ]);

    setAssignmentInput("");
  }

  const calendarHandler = (event: any) => {
    event.preventDefault();
    toggleCalendar(!showCalendar);
  }

  return (
    <header className={styles.header}>
      {/* This is simply to show you how to use helper functions */}
      <h1>Assignment Tracker</h1>
      <form className={styles.newAssignmentForm}>
        <input placeholder="Add a new assignment" type="text" onChange={onChange} value={assignmentInput}/>
        <button className={styles.icon} onClick={calendarHandler}>
          <IoCalendar size={30} />
        </button>
        <div className={showCalendar ? styles.table : styles.hidden}>
          <Calendar setDeadline={setDeadline} toggleCalendar={toggleCalendar}/>
        </div>
        <button 
          className={styles.create} 
          onClick={onCreate}
          disabled={!(assignmentInput&&deadline)}>
          Create <AiOutlinePlusCircle size={20} />
        </button>
      </form>
    </header>
  );
}

export default Header;
