import Header from './components/Header/Header'
import Assignments from './components/Assignments/Assignments'
import { useState } from 'react'

interface AssignmentProperties {
  id: number;
  name: string;
  completed: boolean;
  deadline: Date;
}

const App = () => {
  const [assignmentInput, setAssignmentInput] = useState<string>("");
  const [assignments, setAssignments] = useState<AssignmentProperties[]>([]);
  const [deadline, setDeadline] = useState<Date|undefined>();

  return (
    <>
      <Header 
        assignmentInput={assignmentInput}
        setAssignmentInput={setAssignmentInput}
        assignments={assignments}
        setAssignments={setAssignments}
        deadline={deadline}
        setDeadline={setDeadline}
        />
      <Assignments 
        assignments={assignments}
        setAssignments={setAssignments}
        />
    </>
  );
}

export default App;
