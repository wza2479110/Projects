import styles from './assignment.module.css';
import { TbTrash } from 'react-icons/tb';
import { BsCheckCircleFill } from 'react-icons/bs';
import { calcDaysLeft } from '../../helpers/stringHelpers';


interface AssignmentProperties {
  id: number;
  name: string;
  completed: boolean;
  deadline: Date;
}

interface AssignmentProps {
  assignment: AssignmentProperties;
  assignments: AssignmentProperties[]
  setAssignments: Function;
}

const Assignment = ({ assignment, assignments, setAssignments}: AssignmentProps) => {
  const onComplete = () => {
    setAssignments(
      assignments.map(item => {
        if (item.id === assignment.id) {
          return {...item, completed: !item.completed}
        }
        else {
          return item
        }
    }))
  }

  const onDelete = () => {
    setAssignments(
      assignments.filter(item => item.id !== assignment.id)
    )
  }

  const daysLeft = () => {
    return calcDaysLeft(assignment.deadline);
  }

  return (
    <div className={styles.assignment}>
      <button className={styles.checkContainer} onClick={onComplete}>
        {
          assignment.completed 
            ? <BsCheckCircleFill />
            : <div />
        }
      </button>
      <div className={styles.info}>
        <p className={assignment.completed ? styles.textCompleted : styles.name}>
          {assignment.name}
        </p>
        <p className={daysLeft() === 1 ? styles.tomorrow : styles.deadline}>
          Due: {daysLeft() === 1 ? "tomorrow" : (daysLeft() + " days")}
        </p>
      </div>
      <div className={styles.delete}>
        <button className={styles.deleteButton} onClick={onDelete} >
          <TbTrash size={20} />
        </button>
      </div>
    </div>
  );
}

export default Assignment;
