import { format } from 'date-fns'
export default {
	filters: {
		niceDate(date) {
			return format(date, 'ddd MMM Do');
		}
	}
}