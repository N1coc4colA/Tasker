import { Controller } from '@hotwired/stimulus';
import { getComponent } from '@symfony/ux-live-component';

export default class ProjectBoardController extends Controller
{
    async initialize() {
        this.component = await getComponent(this.element);

        document.querySelectorAll('.issue-container').forEach(issueContainer => {
            issueContainer.ondrop = (ev) => {
                ev.preventDefault();

                const issueId = ev.dataTransfer.getData('text/plain');

                this.component.action('updateIssueStatus', {id: issueId, status: ev.target.dataset['status']});
                console.log(document.getElementById(issueId))
                ev.target.appendChild(document.getElementById(issueId));
            };

            issueContainer.ondragover = (ev) => {
                ev.preventDefault();
            };
        });

        document.querySelectorAll('.issue-item').forEach(issueItem => {
            issueItem.addEventListener('dragstart', (ev) => {
                console.log(ev.target.id);
                ev.dataTransfer.dropEffect = 'move';
                ev.dataTransfer.setData('text/plain', ev.target.id);
            });
        });
    }
}
